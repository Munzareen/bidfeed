<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('command', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize');
    dd("Done");
});

Route::controller(AuthController::class)->group(function () { // AuthController
    Route::get('/', 'signInForm'); // sign in
    Route::get('sign-up', 'signUpForm'); // sign in
    Route::get('sign-in', 'signInForm'); // sign in
    Route::post('login', 'authenticate'); // user authenticate
    Route::post('user_create', 'user_create'); // sign in
    Route::get('otp-verification', 'otpVerification'); // otp verification
    Route::post('otp_verify', 'otpVerify'); // otp verification
});

Route::middleware(['verifyBearerToken'])->group(function () {

    Route::controller(AuthController::class)->group(function () { // AuthController
        Route::get('profile', 'profile'); // Profile    
        Route::get('detail-order/{order_id}', 'detailOrder'); // detail order     
    });

    Route::controller(HomeController::class)->group(function () { // HomeController
        Route::get('home', 'home'); // Home
        Route::post('create-like', 'createLike'); // create like
        Route::get('product-details/{product_id}', 'productDetails'); // Product details
    });
    
    Route::controller(CartController::class)->group(function () { // CartController
        Route::get('cart', 'cart');
        Route::get('add-to-cart', 'addToCart');
        Route::get('update-cart', 'update')->name('update.cart'); 
        Route::delete('remove-from-cart', 'remove');
        Route::get('checkout', 'checkout');
        Route::post('create-order', 'createOrder');
    });

    Route::controller(BidController::class)->group(function () { // BidController
        Route::post('create-bid', 'createBid'); // create bid
    });

    Route::controller(PostController::class)->group(function () { // PostController
        Route::get('create-post', 'createPost'); // create post
    });

    Route::controller(ChatController::class)->group(function () { // BidController
        Route::get('chat-list', 'chatList'); // chat list
        Route::get('get-message', 'getMessage'); // get message
        Route::post('send-message', 'sendMessage'); // get message
    });

});
