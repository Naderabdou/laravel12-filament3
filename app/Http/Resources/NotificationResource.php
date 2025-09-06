<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        return [
            'id'    => $this->id,
            'name'  => $this->data['name_' . app()->getLocale()] ?? null,
            'body'  => $this->data['body_' . app()->getLocale()] ?? null,
            'photo' => $this->data['photo'] ??  str_replace(' ', '%20', asset('storage/' . getSetting('logo'))),
            'date'  => $this->created_at->diffForHumans(),
        ];
    }
}
