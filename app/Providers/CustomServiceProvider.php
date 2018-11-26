<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app->bind(
            'App\Repositories\Contracts\BlogRepoInterface',
            'App\Repositories\Concretes\BlogRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\TicketRepoInterface',
            'App\Repositories\Concretes\TicketRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\EventCommentRepoInterface',
            'App\Repositories\Concretes\EventCommentRepo'
        );
    }
}
