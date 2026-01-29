<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellerFlagsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->boolean('is_verified_seller')->default(false)->after('alerts_display');
            $table->boolean('is_premium_seller')->default(false)->after('is_verified_seller');
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['is_verified_seller', 'is_premium_seller']);
        });
    }

}
