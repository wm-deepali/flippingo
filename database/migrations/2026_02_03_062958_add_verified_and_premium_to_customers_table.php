<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedAndPremiumToCustomersTable extends Migration
{

    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false)->after('status');
            $table->text('verification_note')->nullable()->after('is_verified');

            $table->boolean('is_premium')->default(false)->after('verification_note');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'is_verified',
                'verification_note',
                'is_premium'
            ]);
        });
    }

}
