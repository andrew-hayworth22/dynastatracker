<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends Model
{
    use HasFactory;

    public function dynasty() : BelongsTo {
        return $this->belongsTo(Dynasty::class);
    }

    public function divisions() : HasMany {
        return $this->hasMany(Division::class);
    }
}
