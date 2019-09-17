<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SelectShop
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
        $user = $request->user();
        $shops = $user->shops()->get();

        if (!$request->session()->has('current_shop')) {

            if ($shops->count() == 1) {
                Session::put('current_shop', $shops->first()->code);
                return $next($request);
            }

            return redirect('/shop')->with('status', 'SELECCIONA UNA TIENDA PARA CONTINUAR.');
        }

        return $next($request);
    }
}
