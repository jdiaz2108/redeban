<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('original_file_name');
            $table->integer('records_count');
            $table->integer('invalid_records')->nullable();
            $table->string('invalid_csv')->nullable();
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
        Schema::dropIfExists('load_histories');
    }
}
