<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckDataUpdated
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
        if (!Auth::user()->userData()->first()) {
            return redirect('/home')->with('status', 'ACTUALIZA TUS DATOS PARA CONTINUAR.');
        }

        return $next($request);
    }
}
