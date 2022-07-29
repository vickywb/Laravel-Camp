<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
})->name('home');

Auth::routes();

//Login User Manually
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/user-login', [AuthController::class, 'userLogin'])->name('user-login');

//Socialite Login User
//Google
Route::get('/google-login-user', [OAuthController::class, 'googleLogin'])->name('login-user.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleProviderCallback'])->name('user-google.callback');

//Facebook
Route::get('/facebook-login-user', [OAuthController::class, 'facebookLogin'])->name('login-user.facebook');
Route::get('/auth/facebook/callback', [OAuthController::class, 'handleFacebookProviderCallback'])->name('user-facebook.callback');


Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'index'])->name('user-dashboard');
});


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/success-checkout', [CheckoutController::class, 'successCheckout'])->name('success-checkout');