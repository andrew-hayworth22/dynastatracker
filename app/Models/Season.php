<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Season extends Model
{
    use HasFactory;

    public function dynasty() : BelongsTo {
        return $this->belongsTo(Dynasty::class);
    }

    public function team() : BelongsTo {
        return $this->belongsTo(Team::class);
    }

    public function players() : BelongsToMany {
        return $this->belongsToMany(Player::class);
    }
}
