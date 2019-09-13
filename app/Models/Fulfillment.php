<?php

namespace App\Models;

use App\Models\Point;
use App\Models\InvalidPoint;
use App\Models\FulfillmentResult;
use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    protected $fillable = [
        'goal', 'value', 'user_id', 'event',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fulfillmentResults()
    {
        return $this->hasMany(FulfillmentResult::class);
    }

    public function point()
    {
        return $this->hasMany(Point::class);
    }

    public function invalidpoint()
    {
        return $this->hasMany(InvalidPoint::class);
    }

    // Internal Functions calling relationships
    public function userCategory()
    {
        return $this->user()->with('category');
    }

    public function fulResSameMonth()
    {
        return $this->fulfillmentResults()->whereMonth('created_at', $this['month']);
    }

    // Setting attributes
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

    public function getFulfillmentCountAttribute()
    {
        return $this->fulResSameMonth()->count();
    }

    public function getValueAttribute()
    {
        return $this->fulResSameMonth()->max('transactions');
    }

    public function getMaxLiqAttribute()
    {
        return $this->fulResSameMonth()->whereLiquidated(true)->max('transactions') ?? $this->goal;
    }

    public function getMaxNoLiqAttribute()
    {
        return $this->fulResSameMonth()->whereLiquidated(false)->max('transactions');
    }

    public function getIdFulResAttribute()
    {
        return $this->fulResSameMonth()->whereLiquidated(false)->orderBy('transactions', 'desc')->first(); ;
    }

}
