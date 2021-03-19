<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->foreignId('campaign_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->bigInteger('amount');
            $table->boolean('is_anonim')->default(0);
            $table->longText('comment')->nullable();
            $table->integer('status')->default(0);
            $table->datetime('payment_date')->nullable();
            $table->string('payment_detail_1')->nullable();
            $table->string('payment_detail_2')->nullable();
            $table->string('payment_detail_3')->nullable();
            $table->integer('payment_status')->default(0);
            $table->datetime('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('verified_by')->references('id')->on('users');
            $table->index('invoice');
            $table->index('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
