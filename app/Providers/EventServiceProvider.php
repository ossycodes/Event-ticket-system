<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TicketPurchased' => [
            'App\Listeners\SendTicketPurchasedMail',
        ],

        'App\Events\UserCreated' => [
            'App\Listeners\SendWelcomeMail',
            'App\Listeners\UpdateUserProfile',
            'App\Listeners\PutUserOnline',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\UserLoggedOut',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
