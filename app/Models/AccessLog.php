<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'ip_address', 'user_id', 'event'
    ];

    public static function report()
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

     return $access_logs;
    }

    public static function reportSections()
    {
     $access = AccessLog::select(DB::raw('count(id) as data, event'))
                  ->groupby('event')->get();
     $total = AccessLog::where('event','Inicio de sesión')->count();
     $rows = [];
     $sections = [];
     foreach ($access as $value) {
       array_push($rows,$value->data);
       array_push($sections,$value->event);
     }

     $access_logs = ["rows"=>$rows,"sections"=>$sections,"total"=>$total];

     return $access_logs;
    }

    public static function accessSection($request, $name)
    {
      $data = array(
        'ip_address' => $request->ip(),
        'user_id' => Auth::user()->id,
        'event' => $name
      );
      AccessLog::create($data);

      return true;
    }
}
