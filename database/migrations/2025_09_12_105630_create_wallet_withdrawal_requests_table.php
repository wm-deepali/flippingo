<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletWithdrawalRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_withdrawal_requests', function (Blueprint $table) {
            $table->id();

            // Link to customer
            $table->unsignedBigInteger('customer_id');

            // Link to payment method used for this request
            $table->unsignedBigInteger('payment_method_id');

            // Requested amount
            $table->decimal('amount', 12, 2);

            // Status flow: pending → approved/rejected → processing → completed
            $table->enum('status', ['pending', 'approved', 'rejected',])->default('pending');

            $table->date('payment_date')->nullable();
            $table->string('reference_id')->nullable();
            $table->text('remarks')->nullable();
            $table->string('screenshot')->nullable(); // file path
            
            $table->timestamp('processed_at')->nullable(); // When processed
            $table->unsignedBigInteger('processed_by')->nullable(); // Which admin handled it

            $table->timestamps();

            // Relationships
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_withdrawal_requests');
    }
}
