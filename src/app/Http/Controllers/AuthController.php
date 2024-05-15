<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\User;

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

    public function areaSearch(request $request)
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

    public function genreSearch(request $request)
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

    public function showShopDetail(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $shopId = $request->query('shop_id');

        $shop = Shop::find($shop_id);
        $userId = Auth::id();
        $reservations = Reservation::where('shop_id', $shopId)
                    ->where('user_id', $userId)
                    ->orderBy('date', 'desc')
                    ->orderBy('time', 'desc')
                    ->limit(2)
                    ->get();

        $area = $shop->area;
        $genre = $shop->genre;

        return view('detail', compact('shop', 'area', 'genre', 'reservations'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $shopId = $request->input('shop_id');

        $reservation = new Reservation();
        $reservation->user_id = $userId;
        $reservation->shop_id = $shopId;
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        return view('done');
    }
}
