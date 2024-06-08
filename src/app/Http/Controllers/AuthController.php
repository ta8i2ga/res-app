<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        /*追加実装権限追加*/
        $role = Auth::user()->role_id;

        if ($role == 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($role == 2) {
            return redirect()->route('shop_owner.dashboard');
        } else {
            $genres = Genre::all();
            $areas = Area::all();
            $shops = Shop::all();
            $userId = auth()->id(); // ログインユーザーのIDを取得
            $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();

            return view('index', compact('areas', 'shops', 'genres', 'userFavorites'));
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function addFavorites(Request $request)
    {
        $userId = auth()->id();
        $shopId = $request->input('shop_id');

        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->first();

        if ($existingFavorite) {
            // すでにお気に入りに追加されている場合は削除
            $existingFavorite->delete();
            return back();
        }

        $favorite = new Favorite();
        $favorite->user_id = $userId;
        $favorite->shop_id = $shopId;
        $favorite->save();

        return back();
    }

    public function getMyPage()
    {
        $userId = auth()->id(); // ログインユーザーのIDを取得
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();
        $favoriteShops = Shop::whereIn('id', $userFavorites)->get();

        $reviewedReservationsIds = Review::pluck('reservation_id')->all();
        $reservations = Reservation::where('user_id', auth()->id())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->whereNotIn('id', $reviewedReservationsIds)
            ->get();

        return view('mypage', compact('favoriteShops', 'reservations'));
    }

    /*追加実装管理画面追加 */
    public function shop_owner ()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->get();
        $genres = Genre::all();
        $areas = Area::all();

        foreach ($shops as $shop) {
            $shop->reservations = Reservation::where('shop_id', $shop->id)->get();
        }
        return view('shop_owner', compact('areas', 'genres', 'shops'));
    }

    public function admin()
    {
        return view('admin');
    }

    public function ownerCreate (UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);
        return redirect()->route('admin.dashboard')->with('success', '店舗代表者が作成されました');
    }

    public function shopStore(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = new Shop();
        $shop->shop_name = $validatedData['shop_name'];
        $shop->description = $validatedData['description'];
        $shop->area_id = $validatedData['area_id'];
        $shop->genre_id = $validatedData['genre_id'];
        $shop->user_id = Auth::id();
        $shop->save();

        // 保存した店舗のIDを取得
        $shopId = $shop->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();

            // shop_images/shop_id フォルダを作成
            $directory = public_path('storage/shop_images/' . $shopId);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // フォルダ内の既存ファイル数をカウントして次のファイル名を決定
            $files = glob($directory . '/*');
            $imageName = (count($files) + 1) . '.' . $extension;

            // 画像を保存
            $image->move($directory, $imageName);

            // 画像のパスを更新
            $shop->img_path = 'storage/shop_images/' . $shopId . '/' . $imageName; // 画像パスを店舗IDフォルダに設定
            $shop->save();
        }

        return redirect()->route('shop_owner.dashboard')->with('success', '店舗が追加されました');
    }


    public function shopEdit($id)
    {
        $genres = Genre::all();
        $areas = Area::all();
        $shop = Shop::findOrFail($id);
        return view('shop_edit', compact('shop', 'areas', 'genres'));
    }

    public function shopUpdate(Request $request, $id)
    {
        $shop = Shop::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $shop->shop_name = $request->input('shop_name');
        $shop->description = $request->input('description');
        $shop->area_id = $request->input('area_id');
        $shop->genre_id = $request->input('genre_id');

        $shopId = $shop->id;

        //追加実装：ストレージに保存
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            // shop_images/shop_id フォルダのパス
            $directory = public_path('storage/shop_images/' . $shopId);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // フォルダ内の既存ファイルを取得
            $files = glob($directory . '/*');

            // 20枚を超える場合は最も古いファイルを削除
            if (count($files) >= 20) {
                usort($files, function ($a, $b) {
                    return filemtime($a) - filemtime($b);
                });
                unlink($files[0]); // 最も古いファイルを削除
            }

            // 次のファイル名を決定
            $imageName = (count($files) + 1) . '.' . $extension;

            // 新しい画像を保存
            $image->move($directory, $imageName);

        }

        $shop->save();

        return redirect()->route('shops.edit', ['id' => $shop->id])->with('success', '店舗情報が更新されました。');
    }


}
