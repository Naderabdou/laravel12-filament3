<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnboardingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title_ar' => $this->title_ar ?? null,
            'title_en' => $this->title_en ?? null,
            'desc_ar' => $this->desc_ar ?? null,
            'desc_en' => $this->desc_en ?? null,
            'image' => $this->image ? url("storage/".$this->image) : null
        ];
    }
}
