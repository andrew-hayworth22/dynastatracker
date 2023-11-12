<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dynasty extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'coach_name'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function conferences() : HasMany {
        return $this->hasMany(Conference::class);
    }

    public function seasons() : HasMany {
        return $this->hasMany(Season::class);
    }
}
