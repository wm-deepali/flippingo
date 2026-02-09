<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {

            // usage
            $table->integer('listings')->nullable()->after('package_id');

            // sponsored
            $table->enum('sponsored', ['yes','no'])->default('no');
            $table->integer('sponsored_frequency')->nullable();
            $table->enum('sponsored_unit', ['days','weeks','months'])->nullable();

            // whatsapp
            $table->enum('whatsapp', ['yes','no'])->default('no');
            $table->integer('whatsapp_frequency')->nullable();
            $table->enum('whatsapp_unit', ['days','weeks','months'])->nullable();

            // featured
            $table->enum('featured', ['yes','no'])->default('no');
            $table->integer('featured_frequency')->nullable();
            $table->enum('featured_unit', ['days','weeks','months'])->nullable();

            // alerts
            $table->enum('alerts', ['yes','no'])->default('no');
        });
    }

    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'listings',

                'sponsored',
                'sponsored_frequency',
                'sponsored_unit',

                'whatsapp',
                'whatsapp_frequency',
                'whatsapp_unit',

                'featured',
                'featured_frequency',
                'featured_unit',

                'alerts',
            ]);
        });
    }
};
