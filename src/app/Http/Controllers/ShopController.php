<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function areaSearch(Request $request)
    {
        $selectedAreaId = $request->input('area');
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        $userId = auth()->id(); // ログインユーザーのIDを取得
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();

        if ($selectedAreaId) {
            $shops = Shop::where('area_id', $selectedAreaId)->get();
        } else {
            $shops = Shop::all();
        }

        return view('index', compact('areas', 'shops', 'genres', 'userFavorites'));
    }

    public function genreSearch(Request $request)
    {
        $selectedGenreId = $request->input('genre');
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        $userId = auth()->id(); // ログインユーザーのIDを取得
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();

        if ($selectedGenreId) {
            $shops = Shop::where('genre_id', $selectedGenreId)->get();
        } else {
            $shops = Shop::all();
        }

        return view('index', compact('areas', 'shops', 'genres', 'userFavorites'));
    }

    public function shopSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        $userId = auth()->id(); // ログインユーザーのIDを取得
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();

        $shops = Shop::where('shop_name', 'like', '%' . $keyword . '%')->get();

        return view('index', compact('areas', 'shops', 'genres', 'userFavorites'));
    }

    public function showShopDetail(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $shop = Shop::find($shop_id);

        // ログインしているユーザーのID
        $userId = Auth::id();

        $reviewedReservationsIds = Review::pluck('reservation_id')->all();
        $hasErrors = Session::has('errors') && Session::get('errors')->any();
        $limit = $hasErrors ? 1 : 2;

        // その店舗に関連する予約情報のみを取得
        $reservations = Reservation::where('user_id', $userId)
            ->where('shop_id', $shop_id) // この行を追加
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->whereNotIn('id', Review::pluck('reservation_id')->all())
            ->limit($limit)
            ->get();

        $area = $shop->area;
        $genre = $shop->genre;

        return view('detail', compact('shop', 'area', 'genre', 'reservations'));
    }
}
