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
        $this->app->bind(
            'App\Repositories\Contracts\TransactionRepoInterface',
            'App\Repositories\Concretes\TransactionRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ContactRepoInterface',
            'App\Repositories\Concretes\ContactRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\UserRepoInterface',
            'App\Repositories\Concretes\UserRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\NewsletterRepoInterface',
            'App\Repositories\Concretes\NewsletterRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\PostCommentInterface',
            'App\Repositories\Concretes\PostCommentRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\NotificationRepoInterface',
            'App\Repositories\Concretes\NotificationRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\EventSliderRepoInterface',
            'App\Repositories\Concretes\EventSliderRepo'
        );
        $this->app->bind(
            'App\Repositories\Contracts\SocialaccountRepoInterface',
            'App\Repositories\Concretes\SocialaccountRepo'
        );
        $this->app->bind(
            'App\Services\Contracts\PaymentInterface',
            'App\Services\Concretes\PaystackService'
        );
    }
}
