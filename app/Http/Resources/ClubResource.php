<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->images->first() ? $this->images->first()->image_path : null,
            'rating' => round($this->reviews_avg_rating, 2),
            'address' => new AddressResource($this->whenLoaded('address')),
            'phone' => $this->phone,
            'owner' => $this->provider->name,
            'gender' => $this->gender,
        ];
    }
}
