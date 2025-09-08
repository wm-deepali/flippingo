<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Package Name
            $table->decimal('mrp', 10, 2); // MRP
            $table->decimal('discount', 5, 2)->nullable(); // Discount in %
            $table->decimal('offered_price', 10, 2); // Auto calculated
            $table->integer('listings')->nullable(); // Number of Listings
            $table->integer('listing_duration')->nullable(); // Listing Duration (days)
            $table->integer('validity')->nullable(); // Package Validity (days)
            $table->integer('promotions')->nullable(); // Promotions in a month
            $table->integer('sponsors_days')->nullable(); // Sponsors on front page (days)
            $table->enum('alerts', ['yes', 'no'])->default('no'); // Listing Alerts
            $table->boolean('is_popular')->default(false); // Set as Popular
            $table->enum('status', ['active', 'inactive'])->default('active'); // Package Status
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
        Schema::dropIfExists('packages');
    }
}
