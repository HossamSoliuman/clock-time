<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimezoneDetail extends Model
{
    protected $table = 'timezone_details';

    protected $fillable = [
        'name',
        'name_slug',
        'timezone_long',
        'long_slug',
        'timezone_offset',
        'weight',
    ];
}
