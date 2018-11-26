<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check if user is authenticated
        if (Auth::check()) {
            //if user is authenticated then check if user's role is admin
            if (Auth::User()->checkRole()) {
                return abort(404);
            }
        }
        return $next($request);
    }
}
