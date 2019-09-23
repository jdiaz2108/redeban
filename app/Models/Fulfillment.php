<?php

namespace App\Models;

use App\Models\Shop;
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
    public function shop()
    {
        return $this->belongsTo(Shop::class);
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
    public function shopCategory()
    {
        return $this->shop()->first()->user()->with('category');
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
        return $this->shopCategory()->first()['category']['points_redeem'];
    }

    public function getUserIdentificationAttribute()
    {
        return $this->user()->first()['identification'];
    }

    public function getFulfillmentCountAttribute()
    {
        return $this->fulResSameMonth()->count();
    }

    public function getFulfillmentCountLiquidatedAttribute()
    {
        return $this->fulResSameMonth()->whereLiquidated(true)->count();
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

    public function getShopIdentificationAttribute()
    {
        return $this->shop()->first()['code'];
    }

    public function getShopUserAttribute()
    {
        return $this->shop()->first()['nit'];
    }

}
