<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @property int $addressable_id
 * @property string $addressable_type
 */
class Address extends Model
{
    protected $fillable = [
        'address',
        'lat',
        'lng',
        'addressable_id',
        'addressable_type',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
