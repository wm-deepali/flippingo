<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductOrderIdToPaymentRefundsTable extends Migration
{
    public function up()
    {
        Schema::table('payment_refunds', function (Blueprint $table) {
            $table->unsignedBigInteger('product_order_id')->nullable()->after('subscription_id');

            $table->foreign('product_order_id')
                ->references('id')
                ->on('product_orders')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('payment_refunds', function (Blueprint $table) {
            $table->dropForeign(['product_order_id']);
            $table->dropColumn('product_order_id');
        });
    }
}
