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
        $user = Auth::user();
        if (!$user->updated) {
            return redirect('/update-data')->with('status', 'ACTUALIZA TUS DATOS PARA CONTINUAR.');
        }

        if (!$user->HasUpdateDataPoints) {
            return redirect('/update-data')->with('status', 'CONTINUA GANANDO PUNTOS.');
        }

        return $next($request);
    }
}
