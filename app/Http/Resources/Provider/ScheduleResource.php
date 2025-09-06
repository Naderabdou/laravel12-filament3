<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'activity'  => $this->activity->name ?? null,
            'day'       => $this->day,
            'time_from' => $this->time_from,
            'time_to'   => $this->time_to,
            'trainer'   => $this->trainer,
        ];
    }
}
