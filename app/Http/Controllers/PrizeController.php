<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;
use App\Http\Requests\PrizeRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $prizes = Prize::whereActive(true)->get();
        $prizes = Prize::paginate();

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
    public function edit(Prize $prize)
    {
        $value = $prize['prizeCategories']->pluck('category_id');
        $categories = Category::whereNotIn('id', $value)->get();
        return view('pages.admin.prizes.edit', compact('prize', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrizeRequest $request, Prize $prize)
    {
        $data = $request->all();
        $prize->update($data);
        return redirect('/dashboard/prizes')->with('status', 'Se han actualizado el item correctamente');
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
        $prize->delete();
        return redirect('/dashboard/prizes')->with('status', 'Se han eliminado el item correctamente');
    }
}
