<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug',191)->unique(); // SEO-friendly URL slug
            $table->enum('status', ['Published', 'Draft'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
