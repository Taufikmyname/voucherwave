<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSettingController;
use App\Models\Transaction;
use App\Models\User;

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
Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/categories', [CategoryController::class,'index'])->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');



route::group(['middleware' => ['auth']], function(){

    Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

    Route::get('/cart', [CartController::class,'index'])->name('cart');
    Route::post('/cart/{id}', [CartController::class,'delete'])->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/success', 'CartController@success')->name('success');

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

    Route::get('/dashboard/account', [DashboardSettingController::class,'account'])->name('dashboard-account');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-account-redirect');

});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('dashboard', [AdminDashboardController::class,'index'])->name('admin-dashboard');
        Route::resource('category', [AdminCategoryController::class]);
        Route::resource('user', [UserController::class]);
        Route::resource('product', [ProductController::class]);
        Route::resource('product-gallery', [ProductGalleryController::class]);
        Route::resource('banner', [BannerController::class]);
        Route::resource('transaction', [TransactionController::class]);
        Route::get('transaction/details/{id}', [AdminDashboardController::class,'details'])->name('admin-transaction-details');
        Route::post('transaction/details/{id}', [AdminDashboardController::class,'update'])->name('admin-transaction-details-update');
    });

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
