<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'provider_name' => $this->name,
            'phone'         => $this->phone,
             'clubs'         => ClubResource::collection($this->clubs),
   ];
    }
}
