<?php

namespace App\Models;

use App\User;
use App\Models\Fulfillment;
use App\Models\Point;
USE App\Models\redeemValidateMail;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('value');
    }

    public function redeemValidate()
    {
        return $this->hasMany(redeemValidateMail::class);
    }
}
