<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');   // buyer
            $table->unsignedBigInteger('seller_id');     // ✅ seller/vendor
            $table->unsignedBigInteger('submission_id')->nullable();
            $table->string('order_number',191)->unique();
            $table->decimal('amount', 12, 2);
            $table->decimal('igst', 12, 2)->default(0);
            $table->decimal('cgst', 12, 2)->default(0);
            $table->decimal('sgst', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->timestamp('paid_at')->nullable();
            $table->decimal('commission_rate', 5, 2)->default(0);   // e.g. 10.00 (%)
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->decimal('seller_earning', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('customers')->onDelete('cascade'); // ✅ or `users` if sellers are in users table
            $table->foreign('submission_id')->references('id')->on('form_submissions')->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}
