<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/success-checkout', [CheckoutController::class, 'successCheckout'])->name('success-checkout');