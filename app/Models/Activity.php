<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $category_id
 */
class Activity extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'category_id'];


    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function clubs(): BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'club_activity', 'activity_id', 'club_id');
    }
}
