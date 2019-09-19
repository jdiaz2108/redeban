<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user() ?? null;
        if ($user) {
            if ($user->hasAnyRole('admin')) {
                return redirect('dashboard');
            }
            elseif($user->hasAnyRole('user')) {
                return redirect('home');
            }
        }
    }
}
