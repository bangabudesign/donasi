<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('donations', 'transactions');

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('donations_campaign_id_foreign');
            $table->dropColumn('campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('transactions', 'donations');
        Schema::table('donations', function (Blueprint $table) {
            $table->foreignId('campaign_id')->constrained()->after('id');
        });
    }
}
