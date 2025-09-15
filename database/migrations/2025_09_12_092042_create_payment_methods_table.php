<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();

            // Link to customer/user
            $table->unsignedBigInteger('customer_id');

            // Type of payment method (bank, upi, wire, paypal)
            $table->string('type');

            // Common fields
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('receiver_name')->nullable();

            // UPI specific
            $table->string('upi_id')->nullable();

            // Wire transfer specific
            $table->string('bank_address')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban_number')->nullable();

            // Paypal specific
            $table->string('paypal_email')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
