<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getDepartmentNameAttributes()
    {
        return $this->department()->name;
    }
}
