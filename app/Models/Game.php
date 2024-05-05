<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $appends = ['our_score', 'opp_score'];

    public function opp_team() : BelongsTo
    {
        return $this->belongsTo(Team::class, 'opp_team_id');
    }

    public function season() : BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function getOurScoreAttribute()
    {
        return $this->our_score_q1 + $this->our_score_q2 + $this->our_score_q3 + $this->our_score_q4 + $this->our_score_ot;
    }

    public function getOppScoreAttribute()
    {
        return $this->opp_score_q1 + $this->opp_score_q2 + $this->opp_score_q3 + $this->opp_score_q4 + $this->opp_score_ot;
    }
}
