<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wkblog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('author_id')->nullable()->unsigned();

            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('Borrador')->nullable();

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
        Schema::dropIfExists('wkblog_posts');
    }
}
