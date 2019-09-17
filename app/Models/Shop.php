<?php

namespace App\Models;

use App\User;
use App\Models\Fulfillment;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
