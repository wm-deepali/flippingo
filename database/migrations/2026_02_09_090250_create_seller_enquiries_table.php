<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('seller_enquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained('customers')->cascadeOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->text('message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_enquiries');
    }
}
