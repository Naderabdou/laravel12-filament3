<?php

namespace App\Http\Resources\Provider\PackageSubscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Provider\Package\PackageResource;

class PackageSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? null,
            'provider_id' => $this->provider_id ?? null,
            'status' => $this->status ?? null,
            'payment_status' => $this->payment_status ?? null,
            'payment_method' => $this->payment_method ?? null,
            'total_price' => $this->total_price ?? null,
            'start_date' => $this->start_date ? $this->start_date->toDateString() : null,
            'end_date' => $this->end_date ? $this->end_date->toDateString() : null,
            'package' => new PackageResource($this->package) ?? [],

        ];
    }
}
