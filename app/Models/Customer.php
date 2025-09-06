<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BaseUserType;


class Customer extends BaseUserType
{
    protected static function booted() : void
    {
        static::addGlobalScope('customer', function ($builder) {
            $builder->where('type', 'user');
        });
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function subscriptions() : HasMany
    {
        return $this->hasMany(UserSubscription::class, 'user_id');
    }

}
