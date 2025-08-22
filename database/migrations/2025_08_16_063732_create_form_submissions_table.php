<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->boolean('new')->default(true);
            $table->boolean('important')->default(false);
            $table->text('sender')->nullable();
            $table->longText('data')->nullable();
            $table->string('ip', 45)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
}
