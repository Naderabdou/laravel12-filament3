<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $time_from
 * @property string $time_to
 * @property string $trainer
 * @property string $day
 * @property int $club_id
 * @property int $activity_id
 */
class ClubSchedule extends Model
{
    protected $fillable = ['day', 'time_from', 'time_to', 'trainer', 'club_id', 'activity_id'];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
