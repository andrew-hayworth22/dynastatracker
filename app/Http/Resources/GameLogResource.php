<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'location' => $this->location,
            'type' => $this->type,
            'week' => $this->week,
            'opp_team' => $this->whenLoaded('opp_team', fn () => TeamResource::make($this->opp_team)),
            'opp_score' => $this->opp_score,
            'our_score' => $this->our_score,
            'date' => $this->date,
        ];
    }
}
