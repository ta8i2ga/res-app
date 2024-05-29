<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    // AuthController routes
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/favorites/add', [AuthController::class, 'addFavorites'])->name('favorites.add');
    Route::get('/mypage', [AuthController::class, 'getMyPage'])->name('mypage');

    // ShopController routes
    Route::get('/area-search', [ShopController::class, 'areaSearch'])->name('area.search');
    Route::get('/genre-search', [ShopController::class, 'genreSearch'])->name('genre.search');
    Route::get('/shop-search', [ShopController::class, 'shopSearch'])->name('shop.search');
    Route::get('/detail', [ShopController::class, 'showShopDetail'])->name('shop.detail');

    // ReservationController routes
    Route::post('/detail', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{id}', [ReservationController::class, 'cancelReservation'])->name('reservation.cancel');

    //追加実装:予約編集機能
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');

    //追加実装:評価コメント機能
    Route::get('/reviews/{reservation}', [ReservationController::class, 'reviewCreate'])->name('review.create');
    Route::post('/reviews', [ReservationController::class, 'reviewsStore'])->name('reviews.store');
});

Route::get('/thanks', [AuthController::class, 'thanks']);