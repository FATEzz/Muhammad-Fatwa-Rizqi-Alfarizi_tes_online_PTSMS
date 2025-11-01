<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\PembelianController;
use App\Http\Controllers\Api\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::apiResource('users', UserController::class);
        Route::apiResource('barang', BarangController::class);
        Route::apiResource('pembelian', PembelianController::class);
        Route::get('/reports/pembelian', [ReportController::class, 'reportPembelian']);
    });
});