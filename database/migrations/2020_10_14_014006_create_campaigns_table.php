<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('code');
            $table->bigInteger('donation_target')->default(0);
            $table->datetime('finished_at')->nullable();
            $table->datetime('published_at')->nullable();
            $table->integer('status')->default(0);
            $table->text('short_description');
            $table->text('description');
            $table->string('featured_image')->nullable();
            $table->datetime('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')->constrained();
            $table->foreign('verified_by')->references('id')->on('users');
            $table->index('slug');
            $table->index('code');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
