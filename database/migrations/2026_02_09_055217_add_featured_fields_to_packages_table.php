<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->enum('featured', ['yes', 'no'])->nullable()->after('whatsapp_display');
            $table->integer('featured_frequency')->nullable()->after('featured');
            $table->enum('featured_unit', ['days', 'weeks', 'months'])->nullable()->after('featured_frequency');
            $table->string('featured_display')->nullable()->after('featured_unit');
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'featured',
                'featured_frequency',
                'featured_unit',
                'featured_display'
            ]);
        });
    }
};
