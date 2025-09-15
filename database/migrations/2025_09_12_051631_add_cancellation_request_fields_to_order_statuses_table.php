<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancellationRequestFieldsToOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            // For cancellation request (by buyer)
            $table->foreignId('requested_by')->nullable()->after('delivery_method'); // buyer_id
            $table->timestamp('requested_at')->nullable()->after('requested_by');
        });
    }

    public function down()
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->dropColumn(['requested_by', 'requested_at']);
        });
    }
}
