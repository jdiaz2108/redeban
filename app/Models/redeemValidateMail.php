<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class redeemValidateMail extends Model
{
    protected $fillable = [
        'code', 'user_id', 'prize_id'
	];
}
