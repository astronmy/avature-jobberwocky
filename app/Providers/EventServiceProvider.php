<?php

namespace App\Providers;

use App\Events\JobCreated;
use App\Listeners\SendJobNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        JobCreated::class => [
            SendJobNotification::class,
        ],
    ];
}
