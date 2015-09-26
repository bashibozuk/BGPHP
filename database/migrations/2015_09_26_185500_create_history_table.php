<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('container_id')->unsigned();
            $table->double('longitude', 10, 6);
            $table->double('latitude', 10, 6);
            $table->timestamps();
		    $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('history');
    }
}
