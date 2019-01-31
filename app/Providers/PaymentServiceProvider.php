<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentProviderFactory;

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

    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\PaymentInterface',
            // 'App\Services\Concretes\PaystackService'
            function($app) {
                dd('yeah');
            }
         );
    }
}