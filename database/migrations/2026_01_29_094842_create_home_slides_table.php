<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('highlight')->nullable();

            // ✅ Feature list
            $table->json('features')->nullable();

            // ✅ Image OR Video
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->string('media_path')->nullable();

            // ✅ Buttons
            $table->string('btn1_text')->nullable();
            $table->string('btn1_icon')->nullable();
            $table->string('btn1_link')->nullable();

            $table->string('btn2_text')->nullable();
            $table->string('btn2_icon')->nullable();
            $table->string('btn2_link')->nullable();

            // ✅ Ordering & status
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_slides');
    }
};