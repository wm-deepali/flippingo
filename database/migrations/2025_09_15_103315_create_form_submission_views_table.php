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
            $table->foreignId('form_submission_id')
                  ->constrained('form_submissions')
                  ->cascadeOnDelete();

            // Customer reference, nullable for guests
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers')
                  ->nullOnDelete();

            // IP address for guests
            $table->string('ip_address',191)->nullable();

            // Track by day
            $table->date('view_date');

            $table->timestamps();

            // Ensure uniqueness per submission per day for customers
            $table->unique(
                ['form_submission_id', 'customer_id', 'view_date'],
                'fs_views_sub_cust_date_unique'
            );

            // Ensure uniqueness per submission per day for guest IPs
            $table->unique(
                ['form_submission_id', 'ip_address', 'view_date'],
                'fs_views_sub_ip_date_unique'
            );
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submission_views');
    }
}
