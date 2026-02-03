<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToFormSummaryCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('form_summary_cards', function (Blueprint $table) {
            $table->string('color', 20)
                ->default('#000000')
                ->after('icon');
        });
    }

    public function down(): void
    {
        Schema::table('form_summary_cards', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
