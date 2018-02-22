<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_results', function (Blueprint $table) {
            $table->increments('id');
            $table->date('mes');
            $table->integer('respuesta');
            //Primera llave foranea
            $table->integer('preguntas_id')->unsigned();
            $table->foreign('preguntas_id')->references('id')->on('preguntas');
            //Segunda llave foranea
            $table->integer('hotels_id')->unsigned();
            $table->foreign('hotels_id')->references('id')->on('hotels');
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
        Schema::dropIfExists('qualification_results');
    }
}
