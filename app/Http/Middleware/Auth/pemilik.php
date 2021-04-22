<?php

namespace App\Http\Middleware\Auth;

use App\Database\tbvilla;
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
        return Session::has('role')
        ? ((Session::get('role') === 'pemilik')
        ? ((tbvilla::where('id_pemilik', '=', Session::get('idpemilik'))->count() > 0)
        ? $next($request)
        : redirect()->route('pemilik.vila.tambah'))
        : redirect()->route('home'))
        : redirect()->route('home');
    }
}
