<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Dynasty extends Model
{
    use HasFactory;
    use HasRelationships;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function conferences() : HasMany {
        return $this->hasMany(Conference::class);
    }

    public function seasons() : HasMany {
        return $this->hasMany(Season::class);
    }

    public function teams() : HasManyDeep {
        return $this->hasManyDeep(Team::class, [Conference::class, Division::class]);
    }

    public function players() : HasMany {
        return $this->hasMany(Player::class);
    }
}
