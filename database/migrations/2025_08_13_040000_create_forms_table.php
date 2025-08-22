<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // NOT NULL
            $table->text('slug')->nullable();

            $table->boolean('status')->default(true);
            $table->boolean('is_private')->default(false);
            $table->boolean('use_password')->default(false);
            $table->text('password')->nullable();
            $table->boolean('authorized_urls')->default(false);
            $table->text('urls')->nullable();
            $table->tinyInteger('authorized_urls_error_type')->nullable();
            $table->text('authorized_urls_error_message')->nullable();

            $table->boolean('schedule')->default(false);
            $table->integer('schedule_start_date')->nullable();
            $table->integer('schedule_end_date')->nullable();

            $table->boolean('total_limit')->default(false);
            $table->integer('total_limit_number')->nullable();
            $table->string('total_limit_time_unit', 1)->nullable();
            $table->boolean('total_limit_action')->default(false);

            $table->boolean('user_limit')->default(false);
            $table->tinyInteger('user_limit_type')->nullable();
            $table->tinyInteger('submission_scope')->default(0);
            $table->integer('user_limit_number')->nullable();
            $table->string('user_limit_time_unit', 1)->nullable();

            $table->integer('submission_number')->default(1);
            $table->string('submission_number_prefix', 100)->nullable();
            $table->string('submission_number_suffix', 100)->nullable();
            $table->integer('submission_number_width')->nullable();

            $table->tinyInteger('submission_editable')->default(0);
            $table->integer('submission_editable_time_length')->nullable();
            $table->string('submission_editable_time_unit', 1)->nullable();
            $table->string('submission_timezone', 45)->nullable();
            $table->string('submission_dateformat', 45)->nullable();
            $table->text('submission_editable_conditions')->nullable();

            $table->boolean('save')->default(true);
            $table->boolean('resume')->default(false);
            $table->boolean('autocomplete')->default(true);
            $table->boolean('novalidate')->default(false);
            $table->boolean('analytics')->default(true);
            $table->boolean('honeypot')->default(true);
            $table->boolean('recaptcha')->default(false);
            $table->boolean('protected_files')->default(false);
            $table->boolean('ip_tracking')->default(true);
            $table->boolean('browser_fingerprint')->default(true);

            $table->string('shared_with')->nullable();
            $table->string('language', 5)->default('en-US');
            $table->string('text_direction', 3)->default('ltr');

            $table->text('message')->nullable();
            $table->text('preferences')->nullable();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('forms');
    }
}

