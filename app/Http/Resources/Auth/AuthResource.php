<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'addresses' => AddressResource::collection($this->addresses) ?? [],
            'gender' => $this->gender ?? null,
            'type' => $this->type ?? null,
            'token' => $this->token ?? null,
            'reset_token_password' => $this->reset_token_password ?? null,
        ];
    }
}
