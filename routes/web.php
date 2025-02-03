<?php

use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Middleware\IsAdmin;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSettingController;


//Admin-Controller
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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
Route::get('/categories/{id}', [CategoryController::class,'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class,'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class,'add'])->name('detail-add');

Route::post('/checkout/callback', [CheckoutController::class,'callback'])->name('midtrans-callback');


Auth::routes();

route::group(['middleware' => ['auth']], function(){

    Route::get('/register/success', [AuthRegisterController::class,'success'])->name('register-success');

    Route::get('/cart', [CartController::class,'index'])->name('cart');
    Route::post('/cart/{id}', [CartController::class,'delete'])->name('cart-delete');

    Route::post('/checkout', [CheckoutController::class,'process'])->name('checkout');

    Route::get('/success', [CartController::class,'success'])->name('success');

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class,'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class,'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class,'update'])->name('dashboard-transaction-update');

    Route::get('/dashboard/account', [DashboardSettingController::class,'account'])->name('dashboard-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class,'update'])->name('dashboard-account-redirect');

});

Auth::routes();
// Admin routes group
Route::prefix('admin')
    ->middleware(['auth',IsAdmin::class])
    ->group(function () {
        // Dashboard route
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

        // Resource routes
        Route::resource('category', AdminCategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('transaction', TransactionController::class);

        // Custom transaction routes
        Route::get('transaction/details/{id}', [AdminDashboardController::class, 'details'])->name('admin-transaction-details');
        Route::post('transaction/details/{id}', [AdminDashboardController::class, 'update'])->name('admin-transaction-details-update');
    });

    



Route::get('/home', [HomeController::class,'index'])->name('home');

