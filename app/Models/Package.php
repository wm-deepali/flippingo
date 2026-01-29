<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mrp',
        'discount',
        'offered_price',
        'listings',
        'listings_display',
        'listing_duration',
        'listing_duration_unit',
        'listing_duration_display',
        'validity',
        'validity_unit',
        'validity_display',
        'sponsored',
        'sponsored_frequency',
        'sponsored_unit',
        'sponsored_display',
        'whatsapp',
        'whatsapp_frequency',
        'whatsapp_unit',
        'whatsapp_display',
        'alerts',
        'alerts_display',
        'is_popular',
        'status',
        // ✅ NEW
        'is_verified_seller',
        'is_premium_seller',
    ];


    // Casts for correct data handling
    protected $casts = [
        'mrp' => 'decimal:2',
        'discount' => 'decimal:2',
        'offered_price' => 'decimal:2',
        'is_popular' => 'boolean',
        'is_verified_seller' => 'boolean',
        'is_premium_seller' => 'boolean',
    ];



    // Relationship with subscriptions/orders
    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class, 'package_id');
    // }

    // Accessor for total sales
    // public function getTotalSalesAttribute()
    // {
    //     return $this->subscriptions()->count();
    // }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

}

