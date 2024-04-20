<?php

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

Route::group(['prefix' => 'transactions'], function () {
    Route::get('/', [TransactionController::class, 'index']);
});

Route::group(['prefix' => 'purchases'], function () {
    Route::get('/', [PurchaseController::class, 'index']);
    Route::post('/', [PurchaseController::class, 'store']);
});

Route::group(['prefix' => 'checks'], function () {
    Route::get('/', [CheckController::class, 'index']);
    Route::post('/', [CheckController::class, 'store']);
});
