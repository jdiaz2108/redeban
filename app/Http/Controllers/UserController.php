<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\AccessLog;
use App\Models\Fulfillment;
use Illuminate\Http\Request;
use App\Http\Requests\DataFileRequest;
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
        $users = User::FindUser($request['query'])->with('shops')->paginate();
      } else {
        $users = User::with('shops')->paginate();
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
        ini_set('memory_limit', '-1');
        $file = $request->file('data');

        // Call a Controller and use the processCVSFile method
        CSVFileImporter::loadUserFromFile($file, 'questions');

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
      $access_sections = AccessLog::reportSections();
      $fulfillments_category = Fulfillment::reportFulfillments();

  		return response()->json([
  			"access_logs" => $access_logs,
        "users_categories" => $users_categories,
        "access_sections" => $access_sections,
        "fulfillments_category" => $fulfillments_category
  		]);
    }

    public function activeUsersReport()
    {
        $date = Carbon::now();
        $model = User::has('userData')->with('userData.city', 'city')->get();

           if ($model->isNotEmpty()) {
               // Define download file name
               $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'ActiveUsers.csv';

               // Open file to insert the csv file
               $fp = fopen($fileDir, 'w');

               // Define the headers and insert into the csv file
               $headers = array('Nit', 'Nombre', 'Email', 'Telefono', 'Ciudad', 'Email Actualizado', 'Telefono Actualizado', 'Ciudad Actualizada');

               fputcsv($fp, $headers);

               foreach ($model->chunk(50000) as $t) {
                   $t->map(function ($item, $key) use ($fp) {
                         $var = [$item['identification'], $item['name_company'], $item['email'], $item['phone'], $item->city['name'], $item->userData['email'], $item->userData['phone'], $item->userData['city']['name']];
                         fputcsv($fp, $var);
                         return $var;
                     })->filter()->values()->all();
                }
                // Closing the csv file
                fclose($fp);
                // Downloading the csv generated
                return response()->download($fileDir)->deleteFileAfterSend();

           }
    }

    public function inactiveUsersReport()
    {
        $date = Carbon::now();
        $model = User::doesntHave('userData')->get();

           if ($model->isNotEmpty()) {
               // Define download file name
               $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'InactiveUsers.csv';

               // Open file to insert the csv file
               $fp = fopen($fileDir, 'w');

               // Define the headers and insert into the csv file
               $headers = array('Nit', 'Nombre', 'Email', 'Telefono', 'Ciudad');

               fputcsv($fp, $headers);

               foreach ($model->chunk(50000) as $t) {
                   $t->map(function ($item, $key) use ($fp) {
                         $var = [$item['identification'], $item['name_company'], $item['email'], $item['phone'], $item->city['name']];
                         fputcsv($fp, $var);
                         return $var;
                     })->filter()->values()->all();
                }
                // Closing the csv file
                fclose($fp);
                // Downloading the csv generated
                return response()->download($fileDir)->deleteFileAfterSend();

           }
    }

}
