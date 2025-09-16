<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionViewsTable extends Migration
{
    public function up()
    {
        Schema::create('form_submission_views', function (Blueprint $table) {
            $table->id();

            // Reference to the form submission
            $table->foreignId('form_submission_id')->constrained('form_submissions')->cascadeOnDelete();

            // Customer reference, nullable for guests
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();

            // IP address for guests
            $table->string('ip_address')->nullable();

            $table->timestamps();

            // Ensure uniqueness either by customer_id or IP per submission to count unique views
            $table->unique(['form_submission_id', 'customer_id']);
            // You might also want to add a unique constraint for IP to avoid duplicates for guests:
            $table->unique(['form_submission_id', 'ip_address']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submission_views');
    }
}
