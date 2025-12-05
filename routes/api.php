<?php

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Like\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'index'])
        ->name('posts.index');
    Route::get('/{id}', [PostController::class, 'read'])
        ->name('posts.read');
    Route::get('/{post_id}/comments', [CommentController::class, 'byPost'])
        ->name('posts.comments');
});

Route::prefix('comment/{comment_id}')->group(function() {
    Route::get('/', [CommentController::class, 'read'])
        ->name('comment.read');
    Route::get('/replies', [CommentController::class, 'replies'])
        ->name('comment.replies');
});

Route::prefix('upvotes')->group(function() {
    Route::get('/', [LikeController::class, 'read'])
        ->name('likes.read');
});

Route::middleware('guest')->prefix('user')
    ->group(function() {
        Route::post('/register', [AuthController::class, 'register'])
            ->name('auth.register');
        Route::post('/login', [AuthController::class, 'login'])
            ->name('auth.login');
    });

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('user')->group(function() {
        Route::delete('/logout', [AuthController::class, 'logout'])
            ->name('auth.logout');
    });

    Route::prefix('posts')->group(function() {
        Route::post('/', [PostController::class, 'create'])
            ->name('posts.create');
        Route::put('/{id}', [PostController::class, 'update'])
            ->name('posts.update');
        Route::delete('/{id}', [PostController::class, 'delete'])
            ->name('posts.delete');
    });

    Route::prefix('comment')->group(function() {
        Route::post('/', [CommentController::class, 'create'])
            ->name('comment.create');
        Route::put('/{comment_id}', [CommentController::class, 'update'])
            ->name('comment.update');
        Route::delete('/{comment_id}', [CommentController::class, 'delete'])
            ->name('comment.delete');
    });

    Route::prefix('upvotes')->group(function() {
        Route::post('/', [LikeController::class, 'create'])
            ->name('likes.create');
        Route::delete('/', [LikeController::class, 'delete'])
            ->name('likes.delete');
    });
});
