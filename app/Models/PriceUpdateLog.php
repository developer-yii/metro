<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceUpdateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName',
        'mmid',
        'destination',
        'new_price',
        'old_price',
        'type',
    ];

    const TYPE_MANUAL = 'manual';
    const TYPE_SCHEDULE = 'scheduled';
}
