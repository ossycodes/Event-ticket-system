<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //using class based composers...
        View::composer(
            '*',
            'App\Http\ViewComposers\IndexComposer'
        );
        View::composer(
            'index', 'App\Http\ViewComposers\IndexComposer'
        );
        View::composer(
            'home', 'App\Http\ViewComposers\HomeComposer'
        );
        View::composer(
            'users.receipt.receipt', 'App\Http\ViewComposers\TicketComposer'
        );
        View::composer(
            'events.events', 'App\Http\ViewComposers\EventComposer'
        );
        View::composer(
            'events.single', 'App\Http\ViewComposers\EventSingleComposer'
        );
        View::composer(
            'events.eventviacategory', 'App\Http\ViewComposers\EventViaCategoryComposer'
        );
        View::composer(
            'post', 'App\Http\ViewComposers\PostComposer'
        );
        View::composer(
            'users.transaction.index', 'App\Http\ViewComposers\UserTransactionIndexComposer'
        );
        View::composer(
            'users.profile.index', 'App\Http\ViewComposers\UserProfileIndexComposer'
        );
        View::composer(
            'users.events.edit', 'App\Http\ViewComposers\UserEventEditComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
