<?php

namespace myown\blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('myown\blog\BlogController');
        $this->loadViewsFrom(__DIR__.'/views','Blog');
        $this->loadMigrationsFrom(__DIR__.'migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }
}
