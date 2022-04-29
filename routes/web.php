<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CartController;

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

Route::prefix('admin')->group(base_path('routes/admin.php'));
// Route::prefix('user')->group(base_path('routes/user.php'));
Route::prefix('seller')->group(base_path('routes/seller.php'));

// Route::get('/', function () {
//     return view('welcome');
// });

/**  Route::prefix('admin')->group(function () {
 * SuperAdmin Controller Group
 */
// Route::group(['prefix' => 'admin'], function () {

// });
// Route::get('/admin/{anypath}', [App\Http\Controllers\SuperAdminController::class, 'index'])->where('anypath', '([A-z\d\-\/_.]+)?');

/**
* Routing for Frontend Shop display for general public
*/ 
Route::get('/', [PublicController::class, 'index']);
Route::get('/allproduct', [PublicController::class, 'getProduct']);
Route::get('/allCategory', [PublicController::class, 'getCategory']);
Route::get('/allSubcategory', [PublicController::class, 'getSubcategory']);
Route::get('/catproduct/{url}', [PublicController::class, 'getProductByCategory']);
Route::get('/subcatproduct/{url}', [PublicController::class, 'getProductBySubcat']);
Route::get('/productDetails/{id}', [PublicController::class, 'getProductById']);
Route::get('/proAttribute/{id}', [PublicController::class, 'getAttributes']);
Route::get('/price/{any}/{size}', [PublicController::class, 'getProduct_Price_By_Size']);
Route::get('/check-stock/{id}', [PublicController::class, 'stock']);

/**
 * Routing for CartController to manage cart data for Frontend
 */
Route::get('/items-count/{id}', [CartController::class, 'cartItemCount']);
Route::post('/add-to-cart/{id}', [CartController::class, 'store']);
Route::get('/my-cart', [CartController::class, 'show']);
Route::get('/quantity-increment/{id}', [CartController::class, 'quantityUp']);
Route::get('/quantity-decrement/{id}', [CartController::class, 'quantityDown']);
Route::get('/delete-product/{any}/{quantity}', [CartController::class, 'removeProduct']);
Route::match(['get', 'post'], '/cart-amount', [CartController::class, 'getCartAmount']);

/**
 * Routing for CountriesController to manage country,State and City name for Frontend
 */
Route::get('/country', [CountriesController::class, 'Countries']);
Route::get('/state/{any}', [CountriesController::class, 'States']);
Route::get('/city/{any}', [CountriesController::class, 'Cities']);

Auth::routes();

/**
 * Frontend customer or user register and login
 */
Route::get('user-login', [PublicController::class, 'index'])->name('login');
Route::get('user-register', [PublicController::class, 'index'])->name('register');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/{path}', [PublicController::class, 'index'])->where('path','([A-z\d\-\/_.]+)?');


// Auth::routes(['register' => false, 'login' => false, 'logout' => false]);

/**  newly registered users will automatically be sent an email containing an email verification link  */


 