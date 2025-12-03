<?php

namespace App\Providers;

use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Services\CommentServiceInterface;
use App\Contracts\Services\LikeInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Services\Comment\CommentService;
use App\Services\Like\LikeService;
use App\Services\Post\PostService;
use App\Services\User\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(LikeInterface::class, LikeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
