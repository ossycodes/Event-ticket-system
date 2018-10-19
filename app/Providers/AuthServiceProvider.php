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
        'App\Event' => 'App\Policies\EventPolicy',
        //Blog::class => BlogPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //returns true if the user is an admin, allowing you authorize the admin to
        //view the admin dashbaord
        Gate::define('is-Admin', function(User $user) {
            return Auth::user()->role === "admin"; 
        });
        //returns true if the user is a user, allowing you authorize the user to
        //view the user dashbaord
        Gate::define('is-User', function(User $user) {
            return Auth::user()->role === "user"; 
        });

    }
}
