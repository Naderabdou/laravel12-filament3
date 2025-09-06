<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {

        //dd($request->all());
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'provider_id' => $this->provider_id ?? null,
            'order_number'       => $this->order_number ?? null,
            'status' => $this->status ?? null,
            'payment_status' => $this->payment_status ?? null,
            'payment_method' => $this->payment_method ?? null,
            'total_price' => $this->total_price ?? null,
            'start_date' => $this->start_date ? $this->start_date->toDateString() : null,
            'end_date' => $this->end_date ? $this->end_date->toDateString() : null,
        ];



    }
}
