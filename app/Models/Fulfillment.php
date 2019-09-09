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

    public function userCategory()
    {
        return $this->user()->with('category');
    }

    public function point()
    {
        return $this->hasMany('App\Models\Point');
    }

    public function invalidpoint()
    {
        return $this->hasMany('App\Models\InvalidPoint');
    }

    public function getHasPointAttribute()
    {
        return $this->point()->isNotEmpty();
    }

    public function getPointsAttribute()
    {
        return $this->userCategory()->first()['category']['points_redeem'];
    }

    public function getUserIdentificationAttribute()
    {
        return $this->user()->first()['identification'];
    }

}
