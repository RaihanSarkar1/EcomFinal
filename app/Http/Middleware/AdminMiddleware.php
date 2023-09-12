<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminMiddleware
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
        if(Auth::check()) {
            // check admin role == 1
            // user role == 0
            if(Auth::user()->role == '1') {

                return $next($request);
            } else {
                return redirect('home')->with('message', 'Access Denied as you are not Admin');
            }
        } else {
            return redirect('login')->with('message', 'You are not logged in. Please login');

        }
        return $next($request);
    }
}
