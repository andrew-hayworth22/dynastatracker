<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    //use HasFactory;

    protected $fillable = [
        'division_id',
        'college_name',
        'abbrev_college_name',
        'mascot_name',
        'location'
    ];

    public function division() : BelongsTo {
        return $this->belongsTo(Division::class);
    }
}
