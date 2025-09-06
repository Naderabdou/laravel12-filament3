<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $order_number
 * @property int $user_id
 * @property int $provider_id
 * @property int $provider_package_id
 * @property enum $status
 * @property enum $payment_status
 * @property string $payment_method
 * @property decimal $total_price
 * @property string $start_date
 * @property string $end_date
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property enum $gender
 */
class UserSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'user_id',
        'provider_id',
        'provider_package_id',
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
        'offer_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    protected $appends = ['duration'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(ProviderPackage::class, 'provider_package_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'user_id');
    }
    public function providerPackage()
    {
        return $this->belongsTo(ProviderPackage::class, 'provider_package_id');
    }


    public function getDurationAttribute(): string
    {
        $start = Carbon::parse($this->start_date);
        $end   = Carbon::parse($this->end_date);

        $diff = $start->diff($end);

        if ($diff->y > 0) {
            return $diff->y . ' سنة';
        } elseif ($diff->m > 0) {
            return $diff->m . ' شهر';
        } else {
            return $diff->d . ' يوم';
        }
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
