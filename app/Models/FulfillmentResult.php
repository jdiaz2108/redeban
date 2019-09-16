<?php

namespace App\Models;

use App\Models\Fulfillment;
use Illuminate\Database\Eloquent\Model;

class FulfillmentResult extends Model
{
    public function fulfillment()
    {
        return $this->belongsTo(Fulfillment::class);
    }
}
