<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('mrp', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->decimal('offered_price', 10, 2);

            $table->integer('listings')->nullable();
            $table->string('listings_display')->nullable();

            $table->integer('listing_duration')->nullable();
            $table->enum('listing_duration_unit', ['days', 'months'])->nullable();
            $table->string('listing_duration_display')->nullable();

            $table->integer('validity')->nullable();
            $table->enum('validity_unit', ['days', 'months'])->nullable();
            $table->string('validity_display')->nullable();

            $table->enum('sponsored', ['yes', 'no'])->nullable();
            $table->integer('sponsored_frequency')->nullable();
            $table->enum('sponsored_unit', ['days', 'weeks', 'months'])->nullable();
            $table->string('sponsored_display')->nullable();

            $table->enum('whatsapp', ['yes', 'no'])->nullable();
            $table->integer('whatsapp_frequency')->nullable();
            $table->enum('whatsapp_unit', ['days', 'weeks', 'months'])->nullable();
            $table->string('whatsapp_display')->nullable();

            $table->enum('alerts', ['yes', 'no'])->default('no');
            $table->string('alerts_display')->nullable();

            $table->boolean('is_popular')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
