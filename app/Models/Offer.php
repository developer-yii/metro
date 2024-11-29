<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'productKey',
        'productName',
        'mid',
        'sku',
        'destination',
        'quantity',
        'lowest_price',
        'offer_price',
        'internal_status',
        'offer_json',
        'created_at',
        'updated_at',
        'updated_by'
    ];

    public function customOffer()
    {
        return $this->hasOne(CustomOffer::class, 'productKey', 'productKey')
                    ->where('destination', $this->destination);
    }
}
