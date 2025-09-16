<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_id')->nullable()
                  ->constrained('notification_templates')->nullOnDelete();

            // sender (admin who created it) – if you still have an admins/users table
            $table->unsignedBigInteger('sender_admin_id')->nullable()->index();

            $table->string('subject');
            $table->text('content');
            $table->json('channels')->nullable();
            $table->boolean('is_broadcast')->default(false);
            $table->json('broadcast_filter')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
