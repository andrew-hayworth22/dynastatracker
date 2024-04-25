<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DynastyResource extends JsonResource
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
            'user' => $this->whenLoaded('user', fn () => UserResource::make($this->user)),
            'conferences' => $this->whenLoaded('conferences', fn () => ConferenceResource::collection($this->conferences)),
            'seasons' => $this->whenLoaded('seasons', fn () => SeasonResource::collection($this->seasons)),
            'name' => $this->name,
            'coach_name' => $this->coach_name,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
