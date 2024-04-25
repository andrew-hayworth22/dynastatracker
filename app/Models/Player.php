<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    public function dynasty() : BelongsTo {
        return $this->belongsTo(Dynasty::class);
    }

    public function seasons() : BelongsToMany {
        return $this->belongsToMany(Season::class);
    }
}
