<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'conference' => $this->whenLoaded('conference', fn () => ConferenceResource::make($this->conference)),
            'name' => $this->name,
            'teams' => $this->whenLoaded('teams', fn () => TeamResource::collection($this->teams)),
        ];
    }
}
