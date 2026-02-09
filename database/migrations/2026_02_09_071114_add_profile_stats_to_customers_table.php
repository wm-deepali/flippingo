<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            // Seller portfolio / about section
            $table->text('bio')->nullable()->after('full_address');

            // Stats
            $table->integer('happy_clients')->nullable()->after('bio');
            $table->decimal('total_experience', 4, 1)->nullable()->after('happy_clients');

            // Display / cover image for seller profile
            $table->string('display_image')->nullable()->after('total_experience');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'happy_clients',
                'total_experience',
                'display_image',
            ]);
        });
    }
};
