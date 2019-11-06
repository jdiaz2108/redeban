<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city_id', 'user_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getCityNameAttribute()
    {
        return $this->city()->first()->name;
    }

    public function getDepartmentNameAttribute()
    {
        return $this->city()->first()->department()->first()->name;
    }
}
