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
Route::post('/user-login', [AuthController::class, 'userLogin'])->name('user.login');

//Register User Manually
Route::get('/register', [AuthController::class, 'userRegister'])->name('user.register');
Route::post('/register-user', [AuthController::class, 'userStoreData'])->name('user.store-data');

//Socialite Login User
//Google
Route::get('/google-login-user', [OAuthController::class, 'googleLogin'])->name('user.google-login');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleProviderCallback'])->name('user.google-callback');

//Facebook
Route::get('/facebook-login-user', [OAuthController::class, 'facebookLogin'])->name('user.facebook-login');
Route::get('/auth/facebook/callback', [OAuthController::class, 'handleFacebookProviderCallback'])->name('user.facebook-callback');


Route::middleware(['auth'])->group(function () {
    // Route::get('/');
    Route::get('/user-dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user-change-password', [AuthController::class, 'userChangePassword'])->name('user.change-password');
    Route::get('/user-change-profile', [AuthController::class, 'userChangeProfile'])->name('user.change-profile');
    Route::get('/user-upload-profile', [AuthController::class, 'uploadProfile'])->name('user.upload-profile');
    Route::post('/user-store-password', [AuthController::class, 'storePassword'])->name('user.store-password');
});


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/success-checkout', [CheckoutController::class, 'successCheckout'])->name('success-checkout');