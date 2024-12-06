<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IanaTimezone extends Model
{
    use HasFactory;

    protected $table = 'iana_timezones';

    protected $fillable = [
        'iana_timezone',
        'slug',
        'offset_std',
        'area',
        'weight',
    ];
}
