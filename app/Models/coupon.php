<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\PrizeCategory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'shop_id', 'prize_category_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function prizeCategory()
    {
        return $this->belongsTo(PrizeCategory::class);
    }

    public function user()
    {
        return $this->shop()->first()->user();
    }

    public function getShopCodeAttribute()
    {
        return $this->Shop()->first()->code;
    }

    public function getPrizeNameAttribute()
    {
        return $this->prizeCategory()->first()->prize()->first()->name;
    }

    public function getUserNitAttribute()
    {
        return $this->user()->first()->identification;
    }

    public function getUserNameAttribute()
    {
        return $this->user()->first()->name_company;
    }
}
