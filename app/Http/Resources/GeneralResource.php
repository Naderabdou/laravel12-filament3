<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends JsonResource
{
    public function toArray($request): array
    {
        $data = [
            'id' => $this->resource->id,
            'name' => $this->getName(),
        ];

        return $data;
    }

    private function getName(): string
    {
        return $this->resource->name;
    }
}
