<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOffer extends Model
{
    use HasFactory;

    protected $table = 'custom_offers';

    protected $fillable = [
        'productKey',
        'destination',
        'is_interested_product',
        'percentage',
        'updated_by',
        'sync_interval',
        'last_synced_at'
    ];

    protected $casts = [
        'last_synced_at' => 'datetime'
    ];
}
