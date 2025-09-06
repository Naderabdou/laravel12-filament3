<?php

namespace App\Enums;

enum UserSubscriptionType: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
