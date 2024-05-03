<?php

use App\Http\Controllers\AdminCheckController;
use App\Http\Controllers\AdminUserController;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'transactions'], function () {
        Route::middleware('can:transactions.view')->get('/', [TransactionController::class, 'index']);
    });

    Route::group(['prefix' => 'purchases'], function () {
        Route::middleware('can:purchase.view')->get('/', [PurchaseController::class, 'index']);
        Route::middleware('can:purchase.create')->post('/', [PurchaseController::class, 'store']);
    });

    Route::group(['prefix' => 'checks'], function () {
        Route::middleware('can:checks.view')->get('/', [CheckController::class, 'index']);
        Route::middleware('can:checks.view')->get('/{checkId}', [CheckController::class, 'find']);
        Route::middleware('can:checks.create')->post('/', [CheckController::class, 'store']);
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'checks'], function () {
        Route::middleware('can:checks.list')->get('/', [AdminCheckController::class, 'index']);
        Route::middleware('can:checks.list')->get('/{checkId}', [AdminCheckController::class, 'find']);
        Route::middleware('can:checks.update')->put('/{checkId}', [AdminCheckController::class, 'update']);
    });
    Route::group(['prefix' => 'user'], function () {
        Route::middleware('can:users.update')->put('/{userId}/increase-balance', [AdminUserController::class, 'increaseBalance']);
        Route::middleware('can:users.update')->put('/{userId}/decrease-balance', [AdminUserController::class, 'decreaseBalance']);
    });
});
