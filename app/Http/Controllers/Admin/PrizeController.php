<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PrizeRequest;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prizes = Prize::whereActive(true)->get();
        return view('pages.admin.prizes.index', compact('prizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.prizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrizeRequest $request)
    {
        $data = $request->all();
        // Validate if the request has an image and stogare that file
        if ($request->file('image')) {
            $path = Storage::putFile('public/prizes', $request->file('image'));
            $fullpath = asset(Storage::url($path));
            $data['image'] = $fullpath;
        }
        $prize = new Prize($data);
        $prize->save();
        $prizes = Prize::all();
        return redirect('/dashboard/prizes')->with('status', 'Se han creado un nuevo item correctamente');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize)
    {
        $prize->update(['active' => false]);
        return redirect('/dashboard/prizes')->with('status', 'Se han actualizado los datos correctamente');
    }
}