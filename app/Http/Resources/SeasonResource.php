<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dynasty' => $this->whenLoaded('dynasty', fn () => DynastyResource::make($this->dynasty)),
            'year' => $this->year,
            'team' => $this->whenLoaded('team', fn () => TeamResource::make($this->team)),
            'coach_type' => $this->coach_type,
            'record' => $this->record,
        ];
    }
}
