<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\UserData;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUpdateDataRequest;

class UpdateUserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $updatedData = ($user->updated) ? $user->userData : $user ;
        return view('pages.updateData', compact('updatedData', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUpdateDataRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $userData = new UserData($data);
        $userData->save();
        $date = Carbon::now();
        $points = new Point([
            'event' => 'Actualización de datos',
            'value' => 100,
            'user_id' => $request->user()->id,
            'month' => $date->month,
            'year' => $date->year
        ]);
        $points->save();
        return redirect('/')->with('status', 'Se han actualizado los datos correctamente');
        return back()->with('status', 'Se han actualizado los datos correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userData = UserData::find($id)->update($request->all());
        return back()->with('status', 'Se ha actializado los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
