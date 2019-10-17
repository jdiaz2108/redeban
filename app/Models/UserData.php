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
}
