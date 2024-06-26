<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameViewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'season' => $this->whenLoaded('season', fn () => SeasonResource::make($this->season->load('dynasty', 'team'))),
            'opp_team' => $this->whenLoaded('opp_team', fn () => TeamResource::make($this->opp_team)),
            'location' => $this->location,
            'type' => $this->type,
            'week' => $this->week,
            'coverage' => $this->coverage,
            'date' => $this->date,

            'our_score_q1' => $this->our_score_q1,
            'our_score_q2' => $this->our_score_q2,
            'our_score_q3' => $this->our_score_q3,
            'our_score_q4' => $this->our_score_q4,
            'our_score_ot' => $this->our_score_ot,
            'our_score' => $this->our_score,

            'opp_score_q1' => $this->opp_score_q1,
            'opp_score_q2' => $this->opp_score_q2,
            'opp_score_q3' => $this->opp_score_q3,
            'opp_score_q4' => $this->opp_score_q4,
            'opp_score_ot' => $this->opp_score_ot,
            'opp_score' => $this->opp_score,

            'our_top_percentage' => $this->our_top_min != 0 ? round((($this->our_top_min + ($this->our_top_sec / 60)) / ($this->our_top_min + ($this->our_top_sec / 60) + $this->opp_top_min + ($this->opp_top_sec / 60))) * 100, 2) : 0,
            'opp_top_percentage' => $this->opp_top_min != 0 ? round((($this->opp_top_min + ($this->opp_top_sec / 60)) / ($this->our_top_min + ($this->our_top_sec / 60) + $this->opp_top_min + ($this->opp_top_sec / 60))) * 100, 2) : 0,
        ];
    }
}
