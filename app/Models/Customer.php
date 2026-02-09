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
        'zip_code',
        'commission_rate',
        'last_active',

        // ✅ ADD THESE
        'is_verified',
        'verification_note',
        'verified_at',

        'is_premium',
        'bio',
        'happy_clients',
        'total_experience',
        'display_image'
    ];


    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'last_active' => 'datetime',
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
        'is_premium' => 'boolean',
    ];


    protected $appends = [
        'listing_count',
    ];  // Add this line to append listing_count

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
        return $this->submissions()->where('status', 'published')->count();
    }

    public function kyc()
    {
        return $this->hasOne(CustomerKyc::class, 'customer_id', 'id');
    }

    // One-to-One relationship with Wallet
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    protected static function booted()
    {
        static::created(function ($customer) {
            $customer->wallet()->create([
                'balance' => 0,
                'currency' => 'INR', // optional
                'status' => 'active'  // optional
            ]);
        });
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->latestOfMany(); // always return the latest active subscription
    }

    // In Customer.php
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }


    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_customer')
            ->withPivot(['status', 'read_at', 'is_bookmarked'])
            ->withTimestamps();
    }

    // convenience method
    public function isOnline($thresholdMinutes = 2)
    {
        return $this->last_active && $this->last_active->gt(now()->subMinutes($thresholdMinutes));
    }

    // optionally an accessor
    public function getOnlineAttribute()
    {
        return $this->isOnline();
    }

    // Customer.php

    public function getNameAttribute()
    {
        // Priority: display_name > first_name + last_name > email
        if (!empty($this->display_name)) {
            return $this->display_name;
        }

        if (!empty($this->first_name) || !empty($this->last_name)) {
            return trim($this->first_name . ' ' . $this->last_name);
        }

        return $this->email; // fallback
    }

    // Orders placed by this customer (buyer role)
    public function orders()
    {
        return $this->hasMany(ProductOrder::class, 'customer_id');
    }

    // Orders received (when this customer is seller)
    public function sales()
    {
        return $this->hasMany(ProductOrder::class, 'seller_id');
    }

    // Sellers = customers with listings or active subscription
    public function scopeSellers($query)
    {
        return $query->whereHas('submissions', function ($q) {
            $q->where('published', true);
        })->orWhereHas('activeSubscription');
    }

    // Buyers = customers who placed orders
    public function scopeBuyers($query)
    {
        return $query->whereHas('orders');
    }

    public function recalculatePremiumStatus()
    {
        $threshold = (int) setting('premium_sales_threshold', 0);

        // 2️⃣ If threshold disabled
        if ($threshold <= 0) {
            $this->update([
                'is_premium' => false,
            ]);
            return;
        }

        // 3️⃣ Count delivered orders
        $deliveredCount = ProductOrder::where('seller_id', $this->id)
            ->whereHas('currentStatus', function ($q) {
                $q->where('status', 'delivered');
            })
            ->count();

        // 4️⃣ Apply logic
        if ($deliveredCount >= $threshold) {
            $this->update([
                'is_premium' => true,
            ]);
        } else {
            $this->update([
                'is_premium' => false,
            ]);
        }
    }


}