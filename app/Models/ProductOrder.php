<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'seller_id',
        'submission_id',
        'order_number',
        'amount',
        'igst',
        'cgst',
        'sgst',
        'total',
        'commission_rate',
        'commission_amount',
        'seller_earning',
        'paid_at',
    ];

    protected $dates = [
        'paid_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'product_title',
        'category_name',
        'product_photo',
    ];


    /**
     * Boot method to auto-calc commission & seller earning
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($order) {
            if ($order->commission_rate > 0) {
                $order->commission_amount = round(($order->total * $order->commission_rate) / 100, 2);
                $order->seller_earning = $order->total - $order->commission_amount;
            } else {
                $order->commission_amount = 0;
                $order->seller_earning = $order->total;
            }
        });
    }

    /**
     * Buyer (Customer) who placed the order
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Seller who owns the product
     */
    public function seller()
    {
        return $this->belongsTo(Customer::class, 'seller_id');
        // ⚡ change to User::class if sellers are stored in users table
    }

    /**
     * The form submission linked to this order
     */
    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'submission_id');
    }

    /**
     * Payment related to this order
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'product_order_id');
    }

    /**
     * Invoice generated for this order
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'product_order_id');
    }

    /**
     * Status history of the order
     */
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class, 'product_order_id');
    }

    /**
     * Current/latest status
     */
    public function currentStatus()
    {
        return $this->hasOne(OrderStatus::class, 'product_order_id')->latestOfMany();
    }


    public function getProductTitleAttribute()
    {
        $data = $this->submission ? json_decode($this->submission->data, true) : [];
        return $data['product_title']['value'] ?? '-';
    }

    public function getCategoryNameAttribute()
    {
        return optional($this->submission->form->category)->name ?? '-';
    }

    public function getProductPhotoAttribute()
    {
        $file = $this->submission
            ? $this->submission->files()->where('show_on_summary', true)->first()
            : null;

        return $file ? $file->file_path : null;
    }
}
