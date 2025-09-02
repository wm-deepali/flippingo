<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionFilesTable extends Migration
{
    public function up()
    {
        Schema::create('form_submission_files', function (Blueprint $table) {
            $table->id();

            // Reference to the form submission
            $table->foreignId('form_submission_id')->constrained('form_submissions')->onDelete('cascade');

            // The related form field name for this file
            $table->string('field_name')->nullable();

            // Path to the stored file on disk
            $table->string('file_path');

            // Original filename in upload
            $table->string('original_name')->nullable();

            // MIME type of file
            $table->string('mime_type')->nullable();

            // File size in bytes
            $table->bigInteger('size')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submission_files');
    }
}
