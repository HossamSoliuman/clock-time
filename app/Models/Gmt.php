<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gmt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug','dst', 'utc_name','utc_slug','time_offset'
    ];


    public function timezones()
    {
        return $this->belongsToMany(Timezone::class, 'country_timezone');

    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_timezone');
    }



    /**
     * Get 9 countries excluding a specified country.
     *
     * @param mixed $excludedCountry The country to exclude (ID or name).
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOtherCountries($excludedCountry)
    {
        return $this->countries()
            ->Where('country_id', '!=', $excludedCountry)
            ->take(9)
            ->get();
    }
    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
