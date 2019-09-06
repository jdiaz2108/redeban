<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFileRequest;
use App\Http\Requests\LoadFulfillmentRequest;
use App\Models\Fulfillment;
use App\Models\LoadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FulfillmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fulfillments = Fulfillment::with('user')->paginate();
        $history = LoadHistory::orderBy('id','desc')->paginate();

        return view('pages.admin.fulfillments.index', compact('fulfillments'));
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
    public function store(LoadFulfillmentRequest $request)
    {
        $file = $request->file('data');
        $event = $request['event'];
// Modificación pendiente

        CsvFileImporter::processCSVFile($file, 'fulfillments', false, 10000, $event);

        return redirect()->route('admin::fulfillments.index')->with('status', 'Se han cargado las metas correctamente');
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
    public function update(DataFileRequest $request, $id)
    {
        $file = $request->file('data');

        CsvFileImporter::processCSVFile($file, 'fulfillments', true, 1000, null);

        return redirect()->route('admin::fulfillments.index')->with('status', 'Se han actualizado las metas correctamente');
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
