<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Interfaces\MovementInterface', 'App\Repositories\MovementRepository');
    }
}
