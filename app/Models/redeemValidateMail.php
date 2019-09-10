<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class redeemValidateMail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'user_id', 'prize_id', 'active'
	];
}
