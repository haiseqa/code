<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class pemilik
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
        return Session::has('role') ? ((Session::get('role') === 'pemilik') ? $next($request) : redirect()->route('home')) : redirect()->route('home');
    }
}
