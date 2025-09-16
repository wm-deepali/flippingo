<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key',191)->unique()->comment('unique key like order_placed, wallet_credit');
            $table->enum('type', ['event', 'admin'])->default('event');
            $table->string('subject');
            $table->text('content')->comment('can contain placeholders like {order_id}, {amount}');
            $table->json('channels')->nullable()->comment('["in_app","email","sms"]');

            // recipients
            $table->enum('default_recipient', ['all_customers', 'specific_customers'])
                  ->default('specific_customers')
                  ->comment('Default target audience for this template');

            // placeholders column
            $table->json('placeholders')->nullable()->comment('List of placeholders used in content');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes(); // required because your model uses SoftDeletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
