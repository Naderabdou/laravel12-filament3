<?php

namespace App\Models;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property decimal $price
 * @property int $limit
 * @property int $duration
 * @property json $features
 * @property enum $type
 * @property int $club_id
 * @property int $provider_id
 */
class ProviderPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'price',
        'limit',
        'duration',
        'features',
        'type',
        'club_id',
        'provider_id',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
    ];


    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function offers(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class, 'package_offer');
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'provider_package_id');
    }
}
