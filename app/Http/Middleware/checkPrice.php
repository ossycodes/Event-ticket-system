<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class checkPrice
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

        if ($request->age > 18) {
            return redirect('/');
        }

        return $next($request);
    }
}
