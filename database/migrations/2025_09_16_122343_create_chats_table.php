<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            
            // Who sent the message
            $table->enum('sender_type', ['customer', 'user']);
            $table->unsignedBigInteger('sender_id');
            
            // Who receives the message
            $table->enum('receiver_type', ['customer', 'user']);
            $table->unsignedBigInteger('receiver_id');
            
            // Message content
            $table->text('message');
            
            // Read/unread flag
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();

            // Optional indexes for faster queries
            $table->index(['sender_type', 'sender_id']);
            $table->index(['receiver_type', 'receiver_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
