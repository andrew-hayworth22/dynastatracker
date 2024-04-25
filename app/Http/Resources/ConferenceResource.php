<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceResource extends JsonResource
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
            'dynasty' => $this->whenLoaded('dynasty', fn () => DynastyResource::make($this->dynasty)),
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'divisions' => $this->whenLoaded('divisions', fn () => DivisionResource::collection($this->divisions)),
        ];
    }
}
