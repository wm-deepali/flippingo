<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDeletionRequest extends Model
{
    use HasFactory;

    // Table name (optional if Laravel can infer it)
    protected $table = 'account_deletion_requests';

    // Mass assignable fields
    protected $fillable = [
        'customer_id',
        'reason',
        'status',
    ];

    // Relationship to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
