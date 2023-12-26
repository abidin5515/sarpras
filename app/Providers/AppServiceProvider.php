<?php

namespace App\Providers;
use Bouncer;
use App\User;

use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;// Importing DuskServiceProvider class

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
        if ($this->app->environment('local', 'testing')) {
        $this->app->register(DuskServiceProvider::class);
    }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Bouncer::useUserModel(\App\User::class);


    }
}
