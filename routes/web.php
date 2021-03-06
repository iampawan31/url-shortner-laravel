<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortnerController;

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

Route::get('/', [UrlShortnerController::class, 'index']);
Route::get('/{code}', [UrlShortnerController::class, 'show'])->name('urlShortner.link');
Route::post('/', [UrlShortnerController::class, 'store']);
