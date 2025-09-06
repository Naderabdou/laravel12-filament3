<?php

namespace App\Http\Resources\Provider;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferUserSubscriptionsResource extends JsonResource
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
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'image' => $this->user->avatar,
            'package' => $this->package->name,
            'package_start' => Carbon::parse($this->start_date)->format('Y-m-d'),
            'package_end' => Carbon::parse($this->end_date)->format('Y-m-d'),
            'offer_start' => Carbon::parse($this->offer->start_at)->format('Y-m-d'),
            'offer_end' => Carbon::parse($this->offer->end_at)->format('Y-m-d'),
            'name_offer' => $this->offer->name,

        ];
    }
}
