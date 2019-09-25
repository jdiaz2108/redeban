<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AccessLog;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $request->user()->update(['password' => Hash::make($data['password'])]);
        
        AccessLog::accessSection($request,'Cambio contraseña');

        return back()->with('status', 'SE HA ACTUALIZADO LA CONTRASEÑA CORRECTAMENTE');
    }
}
