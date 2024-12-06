<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTimezone extends Model
{
    use HasFactory;

    protected $table = 'country_timezone';

    protected $fillable = [
        'country_id',
        'timezone_id',
        'gmt_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function gmt()
    {
        return $this->belongsTo(Gmt::class);
    }
}
