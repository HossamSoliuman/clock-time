<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_timezone');
    }

    public function gmt()
    {
        return $this->belongsToMany(Gmt::class,'country_timezone'); // Assuming there's a Gmt model
    }
    public function abbreviations()
    {
        return $this->belongsToMany(Abbreviation::class, 'abbreviation_timezone');

    }

    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
