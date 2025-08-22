<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormChartsTable extends Migration
{
    public function up()
    {
        Schema::create('form_charts', function (Blueprint $table) {
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->string('name', 191);
            $table->text('label');
            $table->text('title');
            $table->text('type');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('gsX')->nullable();
            $table->integer('gsY')->nullable();
            $table->integer('gsW')->nullable();
            $table->integer('gsH')->nullable();
            $table->timestamps();

            $table->primary(['form_id', 'name']); // composite primary
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_charts');
    }
}
