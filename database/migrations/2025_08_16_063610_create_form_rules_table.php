<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormRulesTable extends Migration
{
    public function up()
    {
        Schema::create('form_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->longText('conditions')->nullable();
            $table->longText('actions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_rules');
    }
}
