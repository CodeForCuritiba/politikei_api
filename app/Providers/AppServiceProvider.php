<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;

class AppServiceProvider extends ServiceProvider
{
 	/**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Illuminate\Contracts\Routing\ResponseFactory', function ($app)
        {
            return new ResponseFactory($app['Illuminate\Contracts\View\Factory'], $app['Illuminate\Routing\Redirector']);
        });
    }
}
