<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbbreviationTimezone extends Model
{
    use HasFactory;

    protected $table = 'abbreviation_timezone';

    protected $fillable = [
        'abbreviation_id',
        'timezone_id',
    ];

    public function abbreviation()
    {
        return $this->belongsTo(Abbreviation::class);
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }
}
