<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSponsorDisplayUntilToFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->timestamp('sponsor_display_until')->nullable()->after('expires_at')->comment('Sponsor listing display expiry datetime');
        });
    }

    public function down()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn('sponsor_display_until');
        });
    }
}
