<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormUisTable extends Migration
{
    public function up()
    {
        Schema::create('form_uis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->foreignId('theme_id')->nullable()->constrained('themes');
            $table->text('js_file')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_uis');
    }
}
