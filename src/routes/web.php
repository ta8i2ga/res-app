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
});
Route::get('/thanks', [AuthController::class,'thanks']);

