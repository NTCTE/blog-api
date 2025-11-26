<?php

use App\Http\Controllers\Post\PostController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('posts')->group(function() {
        Route::post('/', [PostController::class, 'create'])
            ->name('posts.create');
    });

    Route::prefix('post')->group(function() {
        Route::put('/{id}', [PostController::class, 'update'])
            ->name('posts.update');
        Route::delete('/{id}', [PostController::class, 'delete'])
            ->name('posts.delete');
    });
});

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'index'])
        ->name('posts.index');
});

Route::prefix('post')->group(function() {
    Route::get('/{id}', [PostController::class, 'read'])
        ->name('posts.read');
});
