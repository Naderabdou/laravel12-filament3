<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderSubscription extends Model
{
    protected $fillable = [
        'order_number',
        'provider_id',
        'package_id',
        'status',
        'payment_status',
        'payment_method',
        'total_price',
        'start_date',
        'end_date',
        'name',
        'email',
        'phone',
        'gender',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }


}
