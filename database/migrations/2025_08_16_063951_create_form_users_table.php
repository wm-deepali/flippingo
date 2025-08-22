<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormUsersTable extends Migration
{
    public function up()
    {
        Schema::create('form_users', function (Blueprint $table) {
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['form_id', 'user_id']); // composite primary key
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_users');
    }
}
