<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'club_name' => $this->club->name,
            'name' => $this->name,
            'discount' => $this->discount,
            'duration' => $this->period,
            'image' => $this->image ? $this->image_path : null,
        ];
    }
}
