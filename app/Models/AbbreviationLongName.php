<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbbreviationLongName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'abbreviation_id',
    ];



    public function abbreviation()
    {
        return $this->belongsTo(Abbreviation::class);
    }

    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
