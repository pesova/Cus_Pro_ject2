<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Routing\UrlGenerator as RoutingUrlGenerator;
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
    public function boot(RoutingUrlGenerator $url)
    {
        // Serve the assets using https scheme on production
        if(env('SET_SECURE_PATH')) {
            $url->forceScheme('https');
        }
    }
}
