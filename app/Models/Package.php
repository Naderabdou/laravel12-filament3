<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $label_ar
 * @property string $label_en
 * @property decimal $price
 * @property json $features_ar
 * @property json $features_en
 * @property int $duration
 * @property enum $type
 */
class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'label_ar',
        'label_en',
        'price',
        'features_ar',
        'features_en',
        'duration',
        'type',
    ];


    protected $casts = [
        'features_ar' => 'array',
        'features_en' => 'array',
    ];


    public function getLabelAttribute(): string
    {
        return $this['label_' . app()->getLocale()];
    }

    public function getFeaturesAttribute(): array
    {
        return $this['features_' . app()->getLocale()];
    }
}
