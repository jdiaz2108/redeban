<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadHistory extends Model
{
    protected $fillable = [
        'original_file_name', 'records_count', 'invalid_records',
    ];
}
