<?php

use Illuminate\Support\Facades\Route;

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



    Route::get('/login', [App\Http\Controllers\Seller\Auth\LoginController::class, 'showLoginForm'])->name('seller.login');
    Route::post('/login', [App\Http\Controllers\Seller\Auth\LoginController::class, 'login'])->name('seller.login.post');
    Route::get('/register', [App\Http\Controllers\Seller\Auth\RegisterController::class, 'showRegistrationForm'])->name('seller.register');
    Route::post('/register', [App\Http\Controllers\Seller\Auth\RegisterController::class, 'register'])->name('seller.register.post');
    Route::post('logout', [App\Http\Controllers\Seller\Auth\LoginController::class, 'logout'])->name('seller.logout.post'); 

Route::group(['middleware' => 'auth:seller'], function() {
    Route::get('/', [App\Http\Controllers\Seller\SellerController::class, 'index'])->name('seller.dashboard');   
});
Route::get('/{anypath}', [App\Http\Controllers\Seller\SellerController::class, 'index'])->where('path', '([A-z\d\-\/_.]+)?');
