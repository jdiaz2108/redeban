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
    public function index(Request $request)
    {
      $name = $request['query'];
      if(is_null($name))
      {
        $fulfillments = Fulfillment::with('shop')->paginate();
      } else {
        $fulfillments = Fulfillment::whereHas('shop', function ($query) use ($name) {
            $query->where('name_company', 'LIKE', "%$name%")->orWhere('identification', 'LIKE', "%$name%");
        })->paginate();
      }

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
        set_time_limit (0);
        $file = $request->file('data');

        // Call csvfileimporter controller and use the processCsvFile function
        // receive 3 parameters (1. file, 2. which table is, 3. if is first load or updated, 4. chunk, 5. Event string)
        CSVFileImporter::storeFulfillmentCsv($file, 'fulfillments', false, 5000, 'Initial load');

        return redirect()->route('admin::histories.index')->with('status', 'Se han cargado las metas correctamente');
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

        CSVFileImporter::loadFulfillmentResults($file, 'fulfillments', true, 1000, null);

        return redirect()->route('admin::histories.index')->with('status', 'Se han actualizado las metas correctamente');
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
