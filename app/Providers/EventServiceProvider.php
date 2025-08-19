<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\LoginListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LoginListener::class,
        ],
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}