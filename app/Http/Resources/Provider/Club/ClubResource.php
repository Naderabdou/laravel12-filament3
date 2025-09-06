<?php

namespace App\Http\Resources\Provider\Club;

use Illuminate\Http\Request;
use App\Http\Resources\ImagesResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ScheduleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'name' => $this->name ?? null,
            'phone' => $this->phone ?? null,
            'desc' => $this->desc ?? null,
            'category' => new CategoryResource($this->category) ?? [],
            'address' => new AddressResource($this->address),
            'activities' => ActivityResource::collection($this->activities) ?? [],
            'images' => ImagesResource::collection($this->images) ?? [],
            'schedules' => ScheduleResource::collection($this->schedules) ?? [],
        ];
    }
}