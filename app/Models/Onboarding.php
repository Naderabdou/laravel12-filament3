<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title_ar
 * @property string $title_en
 * @property string $desc_ar
 * @property string $desc_en
 * @property string $image
 */
class Onboarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'desc_ar',
        'desc_en',
        'image',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function getTitleAttribute(): string
    {
        return $this['title_' . app()->getLocale()];
    }

    public function getDescAttribute(): string
    {
        return $this['desc_' . app()->getLocale()];
    }
}
