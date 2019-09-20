<?php

namespace App\Models;

use App\Models\Prize;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class PrizeCategory extends Model
{
    protected $fillable = [
        'prize_id', 'category_id', 'stock'
    ];

    public function prize()
    {
        return $this->belongsTo(Prize::class)->whereActive(true);
    }

    public function prizeFirst()
    {
        return $this->belongsTo(Prize::class)->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function redeem($id)
    {
      $coupons = Coupon::where('prize_category_id',$id)->count();

      return $coupons;
    }
}
