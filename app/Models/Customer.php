<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'display_name',
        'account_type',
        'legal_name',
        'email',
        'password',
        'mobile',
        'whatsapp_number',
        'mobile_verified_at',
        'email_verified_at',
        'google_id',
        'profile_pic',
        'customer_id',
        'country',
        'status',
        'business_email',
        'full_address',
        'state',
        'city',
        'zip_code'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    protected $appends = ['listing_count'];  // Add this line to append listing_count

    public function countryname()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function billingAddresses()
    {
        return $this->addresses()->where('type', 'billing');
    }

    public function shippingAddresses()
    {
        return $this->addresses()->where('type', 'shipping');
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'customer_id');
    }

    // Accessor to get count of verified listings only
    public function getListingCountAttribute()
    {
        return $this->submissions()->where('published', true)->count();
    }

}