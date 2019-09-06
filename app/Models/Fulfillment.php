<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    protected $fillable = [
        'goal', 'value', 'user_id', 'event',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
