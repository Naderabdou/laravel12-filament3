<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ImagesResource;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubDetailsResource extends JsonResource
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
            'description' => $this->desc,
            'images' => ImagesResource::collection($this->whenLoaded('images')),
            'rating' =>  round($this->reviews_avg_rating, 2) ?? 0,
            'address' => new AddressResource($this->whenLoaded('address')),
            'phone' => $this->phone,
            'owner' => $this->provider->name,
            'gender' => $this->gender ,
            'activities' => $this->activities->select('name'),
            'schedules' => $this->schedules->groupBy('day')->map(fn($items) => ScheduleResource::collection($items)),
            'offers' => OfferResource::collection($this->whenLoaded('offers')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}
