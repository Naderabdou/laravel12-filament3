<?php

namespace App\Http\Resources\Provider\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'label' => $this->label,
            'price' => $this->price,
            'features' => $this->features,
            'duration' => $this->duration . ' ' . $this->type,
        ];
    }
}
