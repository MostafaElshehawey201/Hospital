<?php

namespace App\Providers;

use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerLoginStratgyInterface;
use App\Repositories\Auth\AuthRepository;
use App\Services\Auth\AuthServices;
use App\Stratgies\Auth\Manager\ManagerLoginStratgy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RegisterServiceInterface::class,
            AuthServices::class,
        );
        $this->app->bind(
            RegisterRepositoryInterface::class,
            AuthRepository::class,
        );
        $this->app->bind(
            LoginServiceInterface::class,
            AuthServices::class,
        );
        $this->app->bind(
            ManagerLoginStratgyInterface::class,
            ManagerLoginStratgy::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
