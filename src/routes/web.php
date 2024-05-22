<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/area-search', [AuthController::class, 'areaSearch'])->name('area.search');
    Route::get('/genre-search', [AuthController::class, 'genreSearch'])->name('genre.search');
    Route::get('/shop-search', [AuthController::class, 'shopSearch'])->name('shop.search');
    Route::post('/favorites/add', [AuthController::class, 'addFavorites'])->name('favorites.add');
    Route::get('/detail', [AuthController::class, 'showShopDetail'])->name('shop.detail');
    Route::post('/detail', [AuthController::class, 'store'])->name('reservations.store');
    Route::get('/mypage', [AuthController::class, 'getMyPage'])->name('mypage');
    Route::delete('/reservations/{id}', [AuthController::class, 'cancelReservation'])->name('reservation.cancel');

    //追加実装:予約編集機能
    Route::get('/reservation/edit/{id}', [AuthController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [AuthController::class, 'update'])->name('reservation.update');

    //追加実装:評価コメント機能
    Route::get('/reviews/{reservation}', [AuthController::class, 'reviewCreate'])->name('review.create');
    Route::post('/reviews', [AuthController::class, 'reviewsStore'])->name('reviews.store');
});
Route::get('/thanks', [AuthController::class,'thanks']);

