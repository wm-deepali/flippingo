<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_order_id',
        'status',
        'remarks',
        'delivery_date',
        'delivery_method',
        'cancelled_by',
        'cancellation_reason',
        'cancelled_at',
    ];

    protected $dates = [
        'delivery_date',
        'cancelled_at',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(ProductOrder::class, 'product_order_id');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by'); // or admin/seller table
    }
}
