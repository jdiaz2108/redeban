<?php

namespace App\Models;

use App\Models\PrizeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prize extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'name', 'point', 'description', 'code', 'image', 'active'
	];

    public function getRouteKeyName()
	{
	    return 'code';
    }

    public function prizeCategories()
    {
        return $this->hasMany(PrizeCategory::class);
    }

    public function getTotalStockAttribute()
    {
        return $this->prizeCategories()->sum('stock');
    }

    protected $with = ['prizeCategories.category'];
}
