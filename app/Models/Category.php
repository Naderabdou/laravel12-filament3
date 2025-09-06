<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $icon
 */
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'icon'];

    protected $appends = ['icon_path'];

    public function getIconPathAttribute(): string
    {
        return asset('storage/' . $this->icon);
    }

    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
