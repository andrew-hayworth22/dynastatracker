<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dynasty' => $this->whenLoaded('dynasty', fn () => DynastyResource::make($this->dynasty)),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'weight_lbs' => $this->weight_lbs,
            'is_active' => $this->is_active,
            'reason_left' => $this->reason_left,
            'seasons' => $this->whenLoaded('seasons', fn () => SeasonResource::collection($this->seasons)),
        ];
    }
}
