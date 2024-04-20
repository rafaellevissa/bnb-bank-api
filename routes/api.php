<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::group(['prefix' => 'transactions', 'middleware' => 'auth:api'], function () {
    Route::get('/', [TransactionController::class, 'index']);
});

Route::group(['prefix' => 'purchases', 'middleware' => 'auth:api'], function () {
    Route::get('/', [PurchaseController::class, 'index']);
    Route::post('/', [PurchaseController::class, 'store']);
});

Route::group(['prefix' => 'checks', 'middleware' => 'auth:api'], function () {
    Route::get('/', [CheckController::class, 'index']);
    Route::post('/', [CheckController::class, 'store']);
});
