<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('form_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->text('to')->nullable();
            $table->text('from')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->text('subject')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->text('message')->nullable();
            $table->boolean('plain_text')->default(false);
            $table->boolean('attach')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_emails');
    }
}
