<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seller_feedbacks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();

            $table->tinyInteger('rating'); // 1–5
            $table->text('message')->nullable();

            $table->timestamps();

            // prevent duplicate feedback
            $table->unique(['seller_id', 'customer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_feedbacks');
    }
};
