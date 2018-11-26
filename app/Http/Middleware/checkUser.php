<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class checkUser
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
            //if user is authenticated then check if user's role is user
            if (Auth::user()->role !== "user") {
                return abort(404);
            }
        }


        return $next($request);
    }
}
