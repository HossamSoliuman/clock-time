<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abbreviation extends Model
{
    use HasFactory;

    protected $table = 'abbreviations';
    protected $fillable = [
        'name', 'slug',
    ];


    public function timezones()
    {
        return $this->belongsToMany(Timezone::class, 'abbreviation_timezone');

    }

    public function AbbreviationLongName()
    {
        return $this->hasOne(AbbreviationLongName::class, 'abbreviation_id','id');

    }


    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
