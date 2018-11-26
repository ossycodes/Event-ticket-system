<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\CategoryRepoInterface',
            'App\Repositories\Concretes\CategoryRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\EventRepoInterface',
            'App\Repositories\Concretes\EventRepo'
        );
    }
}
