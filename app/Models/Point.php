<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'event', 'value', 'shop_id', 'month', 'year'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
