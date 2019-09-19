<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class redeemValidateMail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'shop_id', 'prize_category_id', 'active'
	];
}
