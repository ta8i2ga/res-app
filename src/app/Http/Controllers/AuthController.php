<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Review;

class AuthController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $areas = Area::all();
        $shops = Shop::all();

        $userId = auth()->id(); // ログインユーザーのIDを取得
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();

        return view('index', compact('areas', 'shops', 'genres', 'userFavorites'));
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

}
