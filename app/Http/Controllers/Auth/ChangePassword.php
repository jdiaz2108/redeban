<?php

namespace App\Http\Controllers\Auth;

use App\Models\AccessLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;

class ChangePassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangePasswordRequest $request)
    {

        AccessLog::create([
            'ip_address' => $request->ip(),
            'user_id' => $request->user()->id,
            'event' => 'Cambio contraseña'
        ]);

        return back()->with('status', 'SE HA ACTUALIZADO LA CONTRASEÑA CORRECTAMENTE');
    }
}
