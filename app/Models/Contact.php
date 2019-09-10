<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
			'name', 'email', 'phone', 'description' , 'city_id' , 'state'
	];

	public function city()
	{
			return $this->belongsTo('App\Models\City');
	}
}
