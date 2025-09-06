<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageOffer extends Model
{
    protected $table = 'package_offer';
    protected $fillable = ['provider_package_id', 'offer_id'];
}
