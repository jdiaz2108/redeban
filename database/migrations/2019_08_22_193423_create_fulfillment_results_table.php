<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFulfillmentResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulfillment_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transactions');
            $table->boolean('liquidated')->default(false);
            $table->unsignedBigInteger('fulfillment_id')->nullable();
            $table->foreign('fulfillment_id')->references('id')->on('fulfillments');
            // $table->integer('user_id');
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
        Schema::dropIfExists('fulfillment_results');
    }
}
