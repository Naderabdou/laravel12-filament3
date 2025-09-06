<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'description' => $this->desc,
            'gender' => $this->gender,
            'category'    => $this->category->name ?? null,
            'activities'  => ActivityResource::collection($this->activities),
            'schedules'   => ScheduleResource::collection($this->schedules),
            'images'      => ImageResource::collection($this->images),
            'address'     => new AddressResource($this->address),
        ];
    }
}
