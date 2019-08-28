<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
	protected $fillable = [
        'name', 'point', 'description', 'code', 'image', 'stock' ,'active'
	];
	
    public function getRouteKeyName()
	{
	    return 'code';
	}
}
