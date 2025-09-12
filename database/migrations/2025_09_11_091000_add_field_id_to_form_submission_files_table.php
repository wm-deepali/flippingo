<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIdToFormSubmissionFilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('form_submission_files', function (Blueprint $table) {
            $table->string('field_id')->nullable()->after('form_submission_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('form_submission_files', function (Blueprint $table) {
            $table->dropColumn('field_id');
        });
    }
}
