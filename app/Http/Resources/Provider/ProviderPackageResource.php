<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderPackageResource extends JsonResource
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
            'duration' => $this->duration . ' ' . $this->type,
            'price' => $this->price,
            'subscriptions_count' => $this->subscriptions_count,
            'limit' => $this->limit == -1 ? 'Unlimited' : $this->limit,
        ];
    }
}
