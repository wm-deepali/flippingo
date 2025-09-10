<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiresAtToFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('form_submissions', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('published_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('form_submissions', 'expires_at')) {
                $table->dropColumn('expires_at');
            }
        });
    }
}
