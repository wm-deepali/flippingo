<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customer_otp', function (Blueprint $table) {
            // Add type column (mobile or email)
            if (!Schema::hasColumn('customer_otp', 'type')) {
                $table->enum('type', ['mobile', 'email'])->default('mobile')->after('otp');
            }
        });
    }

    public function down()
    {
        Schema::table('customer_otp', function (Blueprint $table) {
            if (Schema::hasColumn('customer_otp', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
