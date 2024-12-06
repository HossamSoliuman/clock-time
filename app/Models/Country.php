<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','code','capital','nationality','weight'];


    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function timezones()
    {
        return $this->belongsToMany(Timezone::class, 'country_timezone');

    }
    public function gmt()
    {
        return $this->belongsToMany(Gmt::class,'country_timezone');
    }

    public function capitalCities()
    {
        $capitalCity = $this->hasMany(City::class)->where('type', 'CAPITAL')->first();

        // Check if a capital city exists, otherwise return null
        return $capitalCity ? $capitalCity : null;
    }

    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
