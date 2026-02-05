<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSliderForToHomeSlides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_slides', function (Blueprint $table) {
            $table->enum('slider_for', ['buyer', 'seller'])->after('title');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_slides', function (Blueprint $table) {
            $table->dropColumn('slider_for');
        });
    }
}
