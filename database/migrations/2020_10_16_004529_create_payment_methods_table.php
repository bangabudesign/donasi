<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // VIRTUALACCOUNT, BANKTRANSFER, PAYMENT_GATEWAY
            $table->string('category'); // INSTANT_PAYMENT, BANK_TRANSFER
            $table->string('name');
            $table->string('short_name');
            $table->string('detail_1')->nullable();
            $table->string('detail_2')->nullable();
            $table->string('detail_3')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('type');
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
