<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use App\Http\Requests\DataFileRequest;

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
        CsvFileImporter::processCSVFile($file, 'users');

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

    public function reportAccess()
    {
      $access = AccessLog::select(DB::raw('count(id) as data'),DB::raw('DATE(created_at) date'))
                ->where('event','Inicio de sesión')->groupby('date')->get();
     $users_all = AccessLog::where('event','Inicio de sesión')->count();
     $rows = [];
     $days = [];
     foreach ($access as $value) {
       array_push($rows,$value->data);
       array_push($days,$value->date);
     }

     $access_logs = ["rows"=>$rows,"days"=>$days,"total"=>$users_all];

  		return response()->json([
  			"access_logs" => $access_logs
  		]);
    }

}
