<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Member extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name_ar',
        'name_en',
        'role_ar',
        'role_en',
        'sort_order'
    ];
    protected $appends = [
        'image_path',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('members')->useDisk('public');
    }
    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }
    public function getRoleAttribute(): string
    {
        return $this['role_' . app()->getLocale()];
    }
    public function getImagePathAttribute(): ?string
    {
        return $this->getFirstMediaUrl('members') ?: null;
    }
}
