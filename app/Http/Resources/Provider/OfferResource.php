<?php

namespace App\Http\Resources\Provider;

use Carbon\Carbon;
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
            'name' => $this->name,
            'discount' => $this->discount,
            'end_at' => Carbon::parse($this->end_at)->format('Y-m-d'),
            'image' => $this->image ? $this->image_path : null,
            'is_active' => $this->is_active ? true : false,
            'subscriptions_count' => $this->subscriptions_count
        ];
    }
}
