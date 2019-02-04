<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\PaymentInterface;

class PaymentServiceProvider extends ServiceProvider
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

    // public function register()
    // {
    //     $this->app->bind(
    //         PaymentInterface::class,
    //         'App\Services\Concretes\PaystackService'
    //         // function($app) {
    //         //     dd('reaching');
    //         // }
    //      );
    // }
}