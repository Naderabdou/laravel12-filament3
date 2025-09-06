<?php

namespace App\Models;

use App\Models\BaseUserType;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends BaseUserType
{
    protected static function booted()
    {
        static::addGlobalScope('provider', function ($builder) {
            $builder->where('type', 'provider');
        });
    }

    public function club(): HasOne
    {
        return $this->hasOne(Club::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function providerPackages(): HasMany
    {
        return $this->hasMany(ProviderPackage::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(ProviderSubscription::class, 'provider_id');
    }

    public function userSubscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class, 'provider_id');
    }
    public function hasActiveSubscription(): bool
    {
        $currentDate = now();

        return $this->subscriptions()
            ->where('status', 'active')
            ->where('payment_status', 'paid')
            ->where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->exists();
    }
}
