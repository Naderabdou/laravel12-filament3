<?php

namespace App\Models;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $desc
 * @property int $category_id
 * @property int $provider_id
 */
class Club extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'desc',
        'category_id',
        'provider_id',
        'gender',
    ];



    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'club_activity', 'club_id', 'activity_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ClubImage::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ClubSchedule::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(ProviderPackage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }



    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['gender'] ?? null, fn($q, $gender) => $q->where('gender', $gender))
            ->when($filters['rating'] ?? null, fn($q, $rating) => $q->withAvg('reviews', 'rating')->having('reviews_avg_rating', '>=', $rating))
            ->when($filters['search'] ?? null, fn($q, $search) => $q->where('name', 'like', "%{$search}%"));
    }


}
