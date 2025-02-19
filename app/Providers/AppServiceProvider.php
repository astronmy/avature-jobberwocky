<?php

namespace App\Providers;

use App\Exceptions\Handler;
use App\Repositories\Interfaces\SubscribersInterface;
use App\Repositories\SubscriberRepository;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
        $this->app->bind(SubscribersInterface::class, SubscriberRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
