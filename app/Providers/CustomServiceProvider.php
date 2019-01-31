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
        $models = [

            'Category',
            'Event',
            'Blog',
            'Ticket',
            'EventComment',
            'Transaction',
            'Contact',
            'User',
            'Newsletter',
            'Post',
            'Notification',
            'EventSlider',
            'Socialaccount',

        ];

        foreach($models as $model) {
            $this->app->bind(
                "App\Repositories\Contracts\{$model}RepoInterface",
                "App\Repositories\Concretes\{$model}Repo"
            );
        }
        
    }
}
