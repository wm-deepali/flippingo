<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notification_customer', function (Blueprint $table) {
            $table->id();

            $table->foreignId('notification_id')->constrained('notifications')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();

            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_bookmarked')->default(false);

            $table->timestamps();

            $table->unique(['notification_id', 'customer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_customer');
    }
};
