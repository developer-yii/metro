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
                    ->where('destination', $this->destination)
                    ->withDefault([
                        'sync_interval' => 3, // Default 3 hours if no custom offer exists
                        'last_synced_at' => null
                    ]);
    }

    public function getSyncIntervalAttribute()
    {
        return $this->customOffer->sync_interval;
    }

    public function getLastSyncedAtAttribute()
    {
        return $this->customOffer->last_synced_at;
    }

    public function updateLastSyncedAt()
    {
        \Log::info("last synced at {$this->productKey} {$this->destination} ".now());
        $customOffer = $this->customOffer;

        // If this is a default/new custom offer, create it first
        if (!$customOffer->exists) {
            $customOffer = CustomOffer::create([
                'productKey' => $this->productKey,
                'destination' => $this->destination,
                'sync_interval' => 3,
                'last_synced_at' => now()
            ]);
        } else {
            $customOffer->last_synced_at = now();
            $customOffer->save();
        }
    }
}
