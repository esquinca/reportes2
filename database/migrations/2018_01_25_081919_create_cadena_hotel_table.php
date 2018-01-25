<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadenaHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadena_hotel', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('cadena_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadenas');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadena_hotel');
    }
}
