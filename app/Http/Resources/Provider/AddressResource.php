<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'full_address' => $this->address,
            'lat'          => $this->lat,
            'lng'          => $this->lng,
        ];
    }
}
