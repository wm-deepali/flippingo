<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['customer_id', 'balance', 'currency', 'status'];

      /**
     * Wallet belongs to a Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function addTransaction($type, $amount, $transactionType, $remarks = null, $referenceId = null)
    {
        $transaction = $this->transactions()->create([
            'type' => $type,
            'amount' => $amount,
            'transaction_type' => $transactionType,
            'remarks' => $remarks,
            'reference_id' => $referenceId,
        ]);

        // Update wallet balance
        if ($type === 'credit') {
            $this->increment('balance', $amount);
        } else {
            $this->decrement('balance', $amount);
        }

        return $transaction;
    }
}
