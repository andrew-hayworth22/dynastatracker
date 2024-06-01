<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'division' => $this->whenLoaded('division', fn () => DivisionResource::make($this->division)),
            'college_name' => $this->college_name,
            'mascot' => $this->mascot,
        ];
    }
}
