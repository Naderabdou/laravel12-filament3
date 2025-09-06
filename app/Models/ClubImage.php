<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $image
 * @property int $club_id
 */
class ClubImage extends Model
{
    protected $fillable = ['image', 'club_id'];


    protected $appends = ['image_path'];

    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
