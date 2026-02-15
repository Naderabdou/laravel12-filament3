<?php

namespace App\Models;

use App\Enums\BlogType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $name_ar
 * @property string $name_en
 * @property string $desc_ar
 * @property string $desc_en
 * @property BlogType $type
 * @property string $image_path
 */
class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'type',
    ];

    protected $casts = [
        'type' => BlogType::class,
    ];

    protected $appends = [
        'image_path',
    ];
    public function getImagePathAttribute(): ?string
    {
        return $this->getFirstMediaUrl($this->type->value) ?: null;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(BlogType::NEWS->value);
        $this->addMediaCollection(BlogType::BLOG->value);
    }
    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }
    public function getDescAttribute(): string
    {
        return $this['desc_' . app()->getLocale()];
    }
}
