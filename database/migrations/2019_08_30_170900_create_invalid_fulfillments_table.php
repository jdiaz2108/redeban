<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvalidFulfillmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invalid_fulfillments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event')->nullable();
            $table->string('goal')->nullable();
            $table->string('value')->nullable();
            $table->string('user_id')->nullable();
            $table->string('period')->nullable();
            $table->unsignedBigInteger('load_historie_id');
            $table->foreign('load_historie_id')->references('id')->on('load_histories');
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
        Schema::dropIfExists('invalid_fulfillments');
    }
}
