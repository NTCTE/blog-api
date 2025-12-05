<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('spa')->group(function() {
    Route::post('/login', [AuthController::class, 'spaLogin'])
        ->name('spa.login');
    Route::delete('/logout', [AuthController::class, 'spaLogout'])
        ->name('spa.logout')
        ->middleware('auth:sanctum');
});
