<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function() {
    Route::middleware('guest')->group(function() {
        Route::post('/register', [AuthController::class, 'register'])
            ->name('register');
        Route::post('/login', [AuthController::class, 'login'])
            ->name('login');
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::delete('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });
});
