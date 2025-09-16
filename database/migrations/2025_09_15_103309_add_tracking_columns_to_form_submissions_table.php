<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingColumnsToFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->unsignedInteger('total_views')->default(0)->after('data');
            $table->unsignedInteger('unique_views')->default(0)->after('total_views');
            $table->unsignedInteger('total_clicks')->default(0)->after('unique_views');
        });
    }

    public function down()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn(['total_views', 'unique_views', 'total_clicks']);
        });
    }
}
