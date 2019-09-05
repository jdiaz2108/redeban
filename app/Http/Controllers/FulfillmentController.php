<?php

namespace App\Http\Controllers;

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
        $history = LoadHistory::orderBy('id','desc')->paginate(100);

        return view('pages.admin.fulfillments.index', compact('history'));
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
        dd($request);
        $file = $request->file('data');
        $event = $request;
// Modificación pendiente

        $importer = new CsvFileImporter;
        $loadHistory = $importer->processCSVFile($file, 'fulfillments', 10000, $event);

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
    public function update(DataFileRequest $request, $id)
    {
        $file = $request->file('data');

        $array = array_map("str_getcsv", file($file));
        $collection = collect($array);

        $date = Carbon::now();

        $collectBody = $collection->splice(1);

        // Get the header of the collection, that means the header is the columns of the table
        $collectHeader = $collection->flatten()->all();


        // Transform between the Body and Header to combinate and make the references columns and rows content
        $collectionMix = $collectBody->map(function ($item, $key) use ($collectHeader) {
            if (count($item) == count($collectHeader)) {
                return collect($collectHeader)->combine($item)->all();
            }
        })->filter()->values()->all();


        foreach (array_chunk($collectionMix, 10000) as $t) {
            $ids = collect($t)->pluck('id');
            Fulfillment::whereIn('id', $ids)->delete();
        }

        foreach (array_chunk($collectionMix,10000) as $t) {
            Fulfillment::insert($t);
        }

        dd($ids);


        $ful = collect([
            ['id' => 1, 'goal' => 218, 'user_id' => 1, 'value' => 200],
            ['id' => 2, 'goal' => 284, 'user_id' => 2,'value' => 250]
            ])->pluck('id');
        Fulfillment::whereIn('id', $ful)->update([[
            'value' => 218
        ],[
            'value' => 210
        ]]);
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
