<?php

namespace App\Http\Controllers;

use App\Models\LoadHistory;
use Illuminate\Http\Request;

class FulfillmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = LoadHistory::orderBy('id','desc')->paginate(100);

        return view('pages.admin.fulfillments.history', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.fulfillments.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('data');

        // Call a Controller and use the processCVSFile method
        $importer = new CsvFileImporter;
        $loadHistory = $importer->processCSVFile($file, 'fulfillments', 10000);

        // if is necessary add the date of every row in fulfillment model
        /* $now = date('Y-m-d H:i:s');
            $date = Carbon::now();
            Fulfillment::whereCreated_at(null)->update(['created_at' => $date, 'updated_at' => $now]); */
            
        return redirect()->route('fulfillments.index')->with('status', 'Se han cargado los registros correctamente');
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
    public function destroy($id)
    {
        //
    }
}
