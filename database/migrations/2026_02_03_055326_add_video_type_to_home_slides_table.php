<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('home_slides', function (Blueprint $table) {

            // Media type: image | video
            if (!Schema::hasColumn('home_slides', 'media_type')) {
                $table->string('media_type')->default('image')->after('features');
            }

            // Video type: upload | youtube | vimeo | external
            if (!Schema::hasColumn('home_slides', 'video_type')) {
                $table->string('video_type')->nullable()->after('media_type');
            }

            // Media path or URL
            if (!Schema::hasColumn('home_slides', 'media_path')) {
                $table->string('media_path')->nullable()->after('video_type');
            }
        });
    }

    public function down()
    {
        Schema::table('home_slides', function (Blueprint $table) {
            if (Schema::hasColumn('home_slides', 'media_path')) {
                $table->dropColumn('media_path');
            }

            if (Schema::hasColumn('home_slides', 'video_type')) {
                $table->dropColumn('video_type');
            }

            if (Schema::hasColumn('home_slides', 'media_type')) {
                $table->dropColumn('media_type');
            }
        });
    }
};

