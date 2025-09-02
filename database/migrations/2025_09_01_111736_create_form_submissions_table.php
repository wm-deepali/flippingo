<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();

            // Reference to the dynamic form
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');

            // Customer (user) who submitted, nullable (guest submissions)
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('set null');

            // JSON column to store submitted form fields (key=>value)
            $table->json('data')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
}
