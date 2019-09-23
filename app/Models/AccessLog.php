<?php

namespace App\Models;

use DB;
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
}
