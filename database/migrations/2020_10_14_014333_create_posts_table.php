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
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('post_type');
            $table->datetime('published_at')->nullable();
            $table->integer('status')->default(0);
            $table->text('body');
            $table->string('featured_image')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')->constrained();
            $table->index('slug');
            $table->index('published_at');
            $table->index('post_type');
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
