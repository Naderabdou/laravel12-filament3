<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property decimal $discount
 * @property date $start_at
 * @property date $end_at
 * @property string $image
 * @property int $club_id
 * @property int $provider_id
 */
class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'discount',
        'start_at',
        'end_at',
        'image',
        'club_id',
        'provider_id',
        'is_active',
    ];
    protected $dates = [
        'start_at',
        'end_at',
    ];


    protected $appends = ['image_path', 'period'];
    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
    ];
    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function providerPackages(): BelongsToMany
    {
        return $this->belongsToMany(ProviderPackage::class, 'package_offer');
    }

    public function getPeriodAttribute(): ?string
    {
        if (!$this->start_at || !$this->end_at) {
            return null;
        }

        $months =  round($this->start_at->diffInMonths($this->end_at));

        if ($months >= 12) {
            $years = round(floor($months / 12));
            return $years . ' سنة';
        }

        return $months . ' شهر';
    }

    public function subscribersCount(): int
    {
        return $this->providerPackages()
            ->withCount('subscriptions')
            ->get()
            ->sum('subscriptions_count');
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'offer_id');
    }
}
