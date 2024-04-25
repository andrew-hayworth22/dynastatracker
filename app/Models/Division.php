<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    public function conference() : BelongsTo {
        return $this->belongsTo(Conference::class);
    }

    public function teams() : HasMany {
        return $this->hasMany(Team::class);
    }
}
