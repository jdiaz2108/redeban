<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'event', 'value', 'user_id', 'month', 'year'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
