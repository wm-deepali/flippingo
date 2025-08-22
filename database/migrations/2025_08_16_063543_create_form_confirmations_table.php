<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormConfirmationsTable extends Migration
{
    public function up()
    {
        Schema::create('form_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->tinyInteger('type')->default(0);
            $table->text('message')->nullable();
            $table->text('url')->nullable();
            $table->boolean('send_email')->default(false);
            $table->text('mail_to')->nullable();
            $table->text('mail_from')->nullable();
            $table->text('mail_subject')->nullable();
            $table->text('mail_message')->nullable();
            $table->text('mail_from_name')->nullable();
            $table->boolean('mail_receipt_copy')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_confirmations');
    }
}
