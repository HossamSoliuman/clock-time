<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'country','score','country_code','timezone'
    ];

    protected $casts = [
        'type' => 'string', // You may also use enums if you implement them.
        'feature' => 'boolean',
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function timezone(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }

    public function slug(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

}
