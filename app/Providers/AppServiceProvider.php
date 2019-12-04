<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::if('docent', function () {
            return auth()->user() && auth()->user()->isDocent();
        });

        Blade::if('admin', function () {
            return auth()->user() && auth()->user()->isAdmin();
        });
    }
}
