<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('enable_country_filter')
                  ->default(false)
                  ->after('show_in_hero');

            $table->string('country_dropdown_label')
                  ->nullable()
                  ->after('enable_country_filter');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'enable_country_filter',
                'country_dropdown_label',
            ]);
        });
    }
};
