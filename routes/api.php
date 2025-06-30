<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BalitaController;
use App\Http\Controllers\api\EdukasiGiziController;
use App\Http\Controllers\api\PengukuranGiziController;

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

        Route::get('balita', [BalitaController::class, 'index']);
        Route::post('balita', [BalitaController::class, 'store']);
        Route::get('balita/{id}', [BalitaController::class, 'show']);
        Route::put('balita/{id}', [BalitaController::class, 'update']);
        Route::delete('balita/{id}', [BalitaController::class, 'destroy']);

        Route::get('edukasi', [EdukasiGiziController::class, 'index']);
        Route::get('edukasi/{id}', [EdukasiGiziController::class, 'show']);

        Route::post('pengukuran-gizi', [PengukuranGiziController::class, 'store']);
        Route::get('pengukuran-gizi', [PengukuranGiziController::class, 'index']);
    });
});
