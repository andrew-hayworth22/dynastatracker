<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $appends = ['record'];

    public function dynasty() : BelongsTo {
        return $this->belongsTo(Dynasty::class);
    }

    public function team() : BelongsTo {
        return $this->belongsTo(Team::class);
    }

    public function players() : BelongsToMany {
        return $this->belongsToMany(Player::class)->withPivot('grade', 'position');
    }

    public function games() : HasMany {
        return $this->hasMany(Game::class);
    }

    public function getRecordAttribute() : string {
        $record = $this->games->countBy(fn ($game) => $game->our_score > $game->opp_score ? 'wins' : 'losses');
        return ($record['wins'] ?? 0) . '-' . ($record['losses'] ?? 0);
    }
}
