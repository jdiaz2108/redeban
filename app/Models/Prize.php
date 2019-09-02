<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prize extends Model
{
	use SoftDeletes;
	
	protected $fillable = [
        'name', 'point', 'description', 'code', 'image', 'stock' ,'active'
	];
	
    public function getRouteKeyName()
	{
	    return 'code';
	}
}
