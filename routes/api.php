<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\API\;

/*
|--------------------------------------------------------------------------
| API Routes      use App\Http\Controllers\;
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * These are Laravel default Route copy from vendor > laravel > ui > src> AuthRouteMethods.php
 */
// reset password route
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// confirm password route
// $this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// $this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// email verification route
// $this->get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// $this->get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// $this->post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
/**
 *|--------------------------------------------------------------------------
 *|  User define API Routes for auhenticated User
 *|--------------------------------------------------------------------------
 */



Route::group(['middleware' => 'cors'], function () {
   // public routes for regster and login
   Route::post('/register', [App\Http\Controllers\API\Auth\RegisterController::class, 'register'])->name('register.api');
   Route::post('/login', [App\Http\Controllers\API\Auth\LoginController::class, 'login'])->name('login.api');

   // reset password route
   Route::get('/password/reset', [App\Http\Controllers\API\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
   Route::post('/password/email', [App\Http\Controllers\API\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.api');
   Route::get('/password/reset/{token}', [App\Http\Controllers\API\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
   Route::post('/password/reset', [App\Http\Controllers\API\Auth\ResetPasswordController::class, 'reset'])->name('password.update.api');

   // confirm password route
   Route::post('/password/confirm', [App\Http\Controllers\API\Auth\ConfirmPasswordController::class, 'confirm']);
 
   // send email verification notice
   Route::get('/email/verify', [App\Http\Controllers\API\Auth\VerificationController::class, 'show'])->name('verification.notice');
   // Verify email
   Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\API\Auth\VerificationController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
   // Resend link to verify email
   Route::post('/email/verify/resend', [App\Http\Controllers\API\Auth\VerificationController::class, 'resend'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.resend');

    // ...
Route::group(['middleware' => 'auth:api'], function () {  
       Route::get('/my-account', [App\Http\Controllers\API\UserController::class, 'getAuthorizedUser']);
       Route::post('/logout', [App\Http\Controllers\API\Auth\LoginController::class, 'logout'])->name('logout');
       //Update User Page
       Route::post('/update-user/{id}', [App\Http\Controllers\API\UserController::class, 'update']);
       Route::post('/current-password', [App\Http\Controllers\API\UserController::class, 'CheckCurrentPassword']);
       //Change Password Page
       Route::post('/update-password/{any}', [App\Http\Controllers\API\UserController::class, 'updatePassword']);
       //Delete User
       Route::get('/delete-user/{id}', [App\Http\Controllers\API\UserController::class, 'destroy']);
       //Check Out page
       Route::match(['get', 'post'],'/check-out', [App\Http\Controllers\CheckOutController::class, 'checkout']);
       //Order Review page
       Route::match(['get', 'post'], '/order-review', [App\Http\Controllers\CheckOutController::class, 'orderReview']);
       //Order Placed page
       Route::match(['get', 'post'], '/cod-order', [App\Http\Controllers\CheckOutController::class, 'placeOrder']);
       //COD Thanks page
       Route::match(['get', 'post'], '/thanks', [App\Http\Controllers\CheckOutController::class, 'thanks']);

       //User's Order page
       Route::get('/orders', [App\Http\Controllers\CheckOutController::class, 'myOrders']);
       //User's Order Details page
       Route::get('/ordersDetail/{any}', [App\Http\Controllers\CheckOutController::class, 'usersOrderDetail']);

       //Route for Paypal To Create Payment
       Route::post('/paypal/create-payment', [App\Http\Controllers\PaypalController::class, 'paypalCreate']);       

       //Route for Paypal To Execute Payment
       Route::post('/paypal/execute-payment', [App\Http\Controllers\PaypalController::class, 'paypalExecute']);
       
       //Paypal Thanks page
       Route::post('/paypal-order', [App\Http\Controllers\PaypalPaymentController::class, 'paypalOrder']);       

       //Route to get paypal payment status after payment
       Route::match(['get', 'post'], '/payment-status', [App\Http\Controllers\PaypalPaymentController::class, 'paypalPaymentStatus']);
    });  
});


 /**
 * Routing for CartController to manage cart data for Frontend
 */
Route::get('/items-count/{id}', [App\Http\Controllers\CartController::class, 'cartItemCount']);
Route::post('/add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'store']);
Route::get('/my-cart', [App\Http\Controllers\CartController::class, 'show']);
Route::get('/quantity-increment/{id}', [App\Http\Controllers\CartController::class, 'quantityUp']);
Route::get('/quantity-decrement/{id}', [App\Http\Controllers\CartController::class, 'quantityDown']);
Route::match(['get', 'post'], '/cart-amount', [App\Http\Controllers\CartController::class, 'getCartAmount']);
Route::get('/delete-product/{any}/{quantity}', [App\Http\Controllers\CartController::class, 'removeProduct']);

/**
 * Routing for CountriesController to manage country,State and City name for Frontend
 */
Route::get('/country', [App\Http\Controllers\CountriesController::class, 'Countries']);
Route::get('/state/{any}', [App\Http\Controllers\CountriesController::class, 'States']);
Route::get('/city/{any}', [App\Http\Controllers\CountriesController::class, 'Cities']);