<?php

namespace App\Providers;

use App\User;
use App\Event;
use App\Policies\EventPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Event' => 'App\Policies\EventPolicy',
        //Event::class => EventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-Admin', function(User $user) {
            return Auth::user()->role === "admin"; 
        });

        Gate::define('is-User', function(User $user) {
            return Auth::user()->role === "user"; 
        });

    }
}
