<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class admin
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
        return Session::has('role') ? ((Session::get('role') === 'admin') ? $next($request) : redirect()->route('home')) : redirect()->route('home');
    }
}
