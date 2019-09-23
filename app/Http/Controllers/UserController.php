<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use App\Http\Requests\DataFileRequest;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!is_null($request['query']))
      {
        $users = User::FindUser($request['query'])->paginate();
      } else {
        $users = User::paginate();
      }

      return view('pages.admin.users.index', compact('users'));
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
    public function store(DataFileRequest $request)
    {
        $file = $request->file('data');

        // Call a Controller and use the processCVSFile method
        CSVFileImporter::loadUserFromFile($file, 'users');

        $collection = User::get(['id']);

            // Validate if the collection is not empty and have data to liquidate
            if ($collection->isNotEmpty()) {

                // Define the headers
                $collectHeader = ['role_id', 'model_type', 'model_id'];

                // Mixing the collection with headers and data to generate points collection
                $collectionMix = $collection->map(function ($item, $key) use ($collectHeader) {

                    // Validate if the user can get points
                    if (!$item->hasAnyRole(['admin', 'user'])) {

                        $array = [2, 'App\User', $item['id']];
                        $arrayUp = Arr::collapse([$array]);
                        return collect($collectHeader)->combine($arrayUp)->all();
                    }

                })->filter()->values()->all();

                foreach (array_chunk($collectionMix, 10000) as $t) {
                    DB::table('model_has_roles')->insert($t);
                }

            }

        return redirect()->route('admin::histories.index')->with('status', 'Se han cargado los usuarios correctamente');
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

    public function reportAdmin()
    {
      $access_logs = AccessLog::report();
      $users_categories = User::reportCategories();

  		return response()->json([
  			"access_logs" => $access_logs,
        "users_categories" => $users_categories
  		]);
    }


}
