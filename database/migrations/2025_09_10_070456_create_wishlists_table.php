<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('submission_id');

            $table->timestamps();

            $table->unique(['customer_id', 'submission_id'],191);

            // Indexes and foreign key constraints (optional if you want to enforce referential integrity)
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('submission_id')->references('id')->on('form_submissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
