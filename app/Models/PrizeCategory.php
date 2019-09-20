<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Prize;
use Illuminate\Database\Eloquent\Model;

class PrizeCategory extends Model
{
    protected $fillable = [
        'prize_id', 'category_id', 'stock', 'point'
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
}
