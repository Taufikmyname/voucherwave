<?php

use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', [AuthRegisterController::class,'check'])->name('api-register-check');
Route::post('callback', [CheckoutController::class,'callback'])->name('midtrans-callback');
