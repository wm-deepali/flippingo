<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_order_id')->constrained('product_orders')->onDelete('cascade');
            $table->string('status'); // e.g., active, processing, delivered, cancelled
            $table->text('remarks')->nullable(); // general remarks for the status

            // Specific fields for delivered
            $table->date('delivery_date')->nullable();
            $table->string('delivery_method')->nullable();

            // Specific fields for cancelled
            $table->foreignId('cancelled_by')->nullable(); // admin_id or seller_id
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
