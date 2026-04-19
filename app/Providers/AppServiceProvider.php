<?php

namespace App\Providers;

use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Interfaces\Auth\RequestOtpInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerLoginStratgyInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerRequestOtpStratgyInterface;
use App\Interfaces\Auth\Stratgy\Process\RequestOtpInterfaceStratgy;
use App\Repositories\Auth\AuthRepository;
use App\Services\Auth\AuthServices;
use App\Stratgies\Auth\Manager\ManagerLoginStratgy;
use App\Stratgies\Auth\Manager\ManagerRequestOtpStratgy;
use App\Stratgies\Auth\Process\EmailRequestOtpStratgy;
use App\Stratgies\Auth\Process\PhoneRequestOtpStratgy;
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
        $this->app->bind(
            RequestOtpInterface::class,
            AuthServices::class,
        );
        $this->app->bind(
            ManagerRequestOtpStratgyInterface::class,
            ManagerRequestOtpStratgy::class,
        );
        $this->app->bind(
            RequestOtpInterfaceStratgy::class,
            EmailRequestOtpStratgy::class,
        );
        $this->app->bind(
            RequestOtpInterfaceStratgy::class,
            PhoneRequestOtpStratgy::class,
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
