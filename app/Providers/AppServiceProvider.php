<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Services\PostService;
use App\Services\CommentService;
use App\Repositories\DashboardRepository;
use App\Repositories\DashboardRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(PostService::class, function ($app) {
            return new PostService(
                $app->make(PostRepositoryInterface::class)
            );
        });
        $this->app->bind(CommentService::class, function ($app) {
            return new CommentService(
                $app->make(CommentRepositoryInterface::class)
            );
        });
        $this->app->bind(DashboardService::class, function ($app) {
            return new DashboardService(
                $app->make(DashboardRepositoryInterface::class)
            );
        });
        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class)
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
