<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ProdukController;
use App\Http\Controllers\api\AbsensiController;
use App\Http\Controllers\api\DinasController;
use App\Http\Controllers\api\AlamatController;
use App\Http\Controllers\api\PesananController;

Route::prefix('v1')->group(function () {
    // Public routes (no authentication required)
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('verify-token', [UserController::class, 'verifyToken']);

    // Protected routes (require authentication)
    Route::middleware('auth:api')->group(function () {
        // User routes
        Route::post('logout', [UserController::class, 'logout']);
        Route::post('password/change', [UserController::class, 'changePassword']);
        Route::post('password/reset', [UserController::class, 'resetPassword']);
        Route::get('profile', [UserController::class, 'profile']);
        Route::put('profile', [UserController::class, 'updateProfile']);
        Route::post('profile/image', [UserController::class, 'uploadImage']);

    });
});
