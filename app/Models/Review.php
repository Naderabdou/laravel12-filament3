<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $comment
 * @property bool $is_approved
 * @property int $rating
 * @property int $user_id
 * @property int $club_id
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'is_approved',
        'rating',
        'user_id',
        'club_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
