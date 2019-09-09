<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvalidPoint extends Model
{
    protected $fillable = [
        'event', 'value', 'user_id', 'month', 'year'
    ];
}
