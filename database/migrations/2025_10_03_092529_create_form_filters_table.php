<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // migration: create_form_filters_table.php
        Schema::create('form_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->string('field_key');   // e.g. "mrp"
            $table->string('label')->nullable(); // "Actual Cost"
            $table->string('type')->nullable();  // "number", "select", "text"
            $table->integer('position')->default(0); // for ordering in UI
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_filters');
    }
}
