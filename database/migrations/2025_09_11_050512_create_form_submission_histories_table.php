<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submission_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_submission_id');
            $table->string('status'); // pending, published, rejected, resubmitted, etc.
            $table->text('admin_remarks')->nullable(); // for rejection remarks or notes
            $table->unsignedBigInteger('changed_by')->nullable(); // admin or user id
            $table->timestamps();

            $table->foreign('form_submission_id')
                ->references('id')
                ->on('form_submissions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_submission_histories');
    }
}
