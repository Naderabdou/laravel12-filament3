<?php

namespace App\Enums;

enum ProviderSubscriptionType: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::ACTIVE => __('Active'),
            self::INACTIVE => __('Inactive'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }
}
