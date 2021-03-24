<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class login
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
        return Session::has('login') ? ((Session::get('login') === true ) ? $next($request) : redirect()->route('login')) : redirect()->route('login');
    }
}
