<?php

namespace App\Models;

use Carbon\Carbon;
use App\User;
use App\Models\Fulfillment;
use App\Models\Point;
USE App\Models\redeemValidateMail;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function getRouteKeyName()
    {
        return 'code';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function redeemValidate()
    {
        return $this->hasMany(redeemValidateMail::class);
    }

    public function fulfillment()
    {
        return $this->hasMany(Fulfillment::class)->latest()->first();
    }

    public function fulfillmentSameMonth()
    {
        $date = Carbon::now();
        return $this->hasMany(Fulfillment::class)->where('month',$date->month)->where('year',$date->year)->first();
    }

    public function fulfillmentAll()
    {
        return $this->hasMany(Fulfillment::class)->latest()->get();
    }

    // Attributes zone
    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('value');
    }

    public function getPointsByUpdatingDataAttribute()
    {
        return $this->points()->whereEvent('Actualización de datos')->get()->isNotEmpty() ? true : false;
    }

    public function getNitAttribute()
    {
        return $this->user()->first()['identification'] ;
    }

    public function getActiveRedeemAttribute()
    {
        return $this->redeemValidate()->latest()->first();
    }

    public function getFulfillmentGoalAttribute()
    {
        return ($this->fulfillmentSameMonth()['goal']) ? $this->fulfillmentSameMonth()['goal'] : 0 ;
    }

    //

    public function CategoryId()
    {
        return $this->user()->first()->category_id;
    }

    public function getFirstPrizePointAttribute()
    {
        return PrizeCategory::whereCategoryId($this->CategoryId())->min('point');
    }

    public function getPointsRedeemCategoryAttribute()
    {
        return Category::find(2)->points_redeem;
    }

    public function getFirstGoalAttribute()
    {
        return ($this->firstPrizePoint / $this->PointsRedeemCategory) ? ((integer) ($this->firstPrizePoint / $this->PointsRedeemCategory) + $this->FulfillmentGoal) : 0 ;
    }

    public function getFulfillmentValueAttribute()
    {
        return ($this->fulfillment()['value']) ? $this->fulfillment()['value'] : 0 ;
    }

}
