<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('post_title', 256);
            $table->string('post_slug', 256);
            $table->text('post_content');
            $table->string('tags', 256);
            $table->string('post_thumbnail', 256);
            $table->bigInteger('category_id');
            $table->bigInteger('views')->default(0);
            $table->string('post_status', 56)->default('active');
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
        Schema::dropIfExists('posts');
    }
}
