<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class notlogin
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
        return Session::has('login') ? redirect()->route('home') : $next($request);
    }
}
