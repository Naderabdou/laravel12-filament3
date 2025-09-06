<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderClubResource extends JsonResource
{
    public function toArray($request)
    {
                // جلب العروض للنادي
        $offers = $this->providerPackage->club->offers ?? collect();


        return [
            'subscriber_name'    => $this->name, // اسم المشترك
            'subscriber_phone'   => $this->phone, // رقم المشترك
            'subscription_type'  => $this->providerPackage->type ?? null, // نوع الاشتراك monthly أو yearly
            'start_date'         => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date'           => $this->end_date?->format('Y-m-d H:i:s'),
            'offers' => $offers->map(function ($offer) {
                return [
                    'offer_name'  => $offer->name,
                    'offer_start' => $offer->start_at?->format('Y-m-d H:i:s') ?? null,
                    'offer_end'   => $offer->end_at?->format('Y-m-d H:i:s') ?? null,
                ];
            }),
        ];
    }
}
