<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerKycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_kyc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('pan_number')->nullable();
            $table->string('pan_document')->nullable();
            $table->string('aadhaar_number')->nullable();
            $table->string('aadhaar_front')->nullable();
            $table->string('aadhaar_back')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('gst_document')->nullable();
            $table->string('personal_id_number')->nullable();
            $table->string('personal_id_document')->nullable();
            $table->string('entity_registration_number')->nullable();
            $table->string('entity_registration_document')->nullable();
            $table->string('tax_registration_number')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_kyc');
    }
}
