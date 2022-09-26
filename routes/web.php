<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CampBenefitController;
use App\Http\Controllers\Admin\CampController;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

    //Login User Manually
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/user-login', [AuthController::class, 'userLogin'])->name('login.user');

    //Register User Manually
    Route::get('/register', [AuthController::class, 'userRegister'])->name('user.register');
    Route::post('/register-user', [AuthController::class, 'userStoreData'])->name('user.store-data');

    //Socialite Login User
    //Google
    Route::get('/google/login', [OAuthController::class, 'googleLogin'])->name('google.login');
    Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleProviderCallback'])->name('google.callback');

    //Facebook
    Route::get('/facebook/login', [OAuthController::class, 'facebookLogin'])->name('user.facebook-login');
    Route::get('/auth/facebook/callback', [OAuthController::class, 'handleFacebookProviderCallback'])->name('user.facebook-callback');

    //Midtrans routes
    Route::get('/payment/success', [CheckoutController::class, 'midtransCallback']);
    Route::post('/payment/success', [CheckoutController::class, 'midtransCallback']);

    Route::prefix('user')
        ->namespace('user.')
        ->group(function () {
        
        Route::middleware(['auth'])->group(function () {
            //Login User
            Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
            Route::get('/change-password', [AuthController::class, 'userChangePassword'])->name('user.change-password');
            Route::get('/{user}/change-profile', [AuthController::class, 'userChangeProfile'])->name('user.change-profile');
            Route::patch('/{user}/upload-profile', [AuthController::class, 'uploadProfile'])->name('user.upload-profile');
            Route::post('/store-password', [AuthController::class, 'storePassword'])->name('user.store-password');

            //Checkout
            Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
            Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
            Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');
        });
    });

    //Login Admin
    Route::prefix('admin')
        ->namespace('admin.')
        ->group(function () {
            Route::get('/login', [AdminAuthController::class, 'renderLogin'])->name('login-admin');
            Route::post('/login', [AdminAuthController::class, 'login'])->name('login.admin');

            Route::middleware(['auth', 'isAdmin'])->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

                //Update Checkouts
                Route::post('/checkout/{checkout}', [AdminCheckoutController::class, 'updateCheckout'])->name('admin.update.checkout');

                //Camps
                Route::get('/camps', [CampController::class, 'index'])->name('admin.camp.index');
                Route::get('/camp/create', [CampController::class, 'create'])->name('admin.camp.create');
                Route::post('/camp/store', [CampController::class, 'store'])->name('admin.camp.store');
                Route::get('/camp/{camp}/edit', [CampController::class, 'edit'])->name('admin.camp.edit');
                Route::patch('/camp/{camp}/update', [CampController::class, 'update'])->name('admin.camp.update');
                Route::delete('/camp/{camp}/delete', [CampController::class, 'destroy'])->name('admin.camp.delete');

                //Camp Benefits
                Route::get('/camp/benefits', [CampBenefitController::class, 'index'])->name('admin.camp-benefit.index');
                Route::get('/camp/benefits/create', [CampBenefitController::class, 'create'])->name('admin.camp-benefit.create');
                Route::post('/camp/benefits/store', [CampBenefitController::class, 'store'])->name('admin.camp-benefit.store');
                Route::get('/camp/benefits/{camp_benefit}/edit', [CampBenefitController::class, 'edit'])->name('admin.camp-benefit.edit');
                Route::patch('/camp/benefits/{camp_benefit}/update', [CampBenefitController::class, 'update'])->name('admin.camp-benefit.update');
                Route::delete('/camp/benefits/{camp_benefit}/delete', [CampBenefitController::class, 'destroy'])->name('admin.camp-benefit.delete');


                //Discounts
                Route::get('/discounts', [DiscountController::class, 'index'])->name('admin.discount.index');
                Route::get('/discount/create', [DiscountController::class, 'create'])->name('admin.discount.create');
                Route::post('/discount/store', [DiscountController::class, 'store'])->name('admin.discount.store');
                Route::get('/discount/{discount}/edit', [DiscountController::class, 'edit'])->name('admin.discount.edit');
                Route::patch('/discount/{discount}/update', [DiscountController::class, 'update'])->name('admin.discount.update');
                Route::delete('/discount/{discount}/delete', [DiscountController::class, 'destroy'])->name('admin.discount.delete');

                //Transactions
                Route::get('/transactions', [TransactionController::class,  'index'])->name('admin.transaction.index');
                Route::get('/transactions/{checkout}/show', [TransactionController::class, 'show'])->name('admin.transaction.show');
        });
    }); 

 
