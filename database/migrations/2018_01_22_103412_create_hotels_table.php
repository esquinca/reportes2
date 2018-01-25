<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre_hotel');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('Pais');
            $table->string('Estado');
            //Primera llave foranea
            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadenas');
            //Segunda llave foranea
            $table->integer('vertical_id')->unsigned();
            $table->foreign('vertical_id')->references('id')->on('verticals');
            //---------------------
            $table->text('dirlogo1')->nullable();
            //Tercera llave foranea
            $table->integer('operaciones_id')->unsigned();
            $table->foreign('operaciones_id')->references('id')->on('operaciones');
            //---------------------
            $table->binary('temp')->nullable();
            $table->text('Fecha_inicioP')->nullable();
            $table->text('Fecha_terminoP')->nullable();
            // $table->text('Responsable')->nullable();
            // $table->text('AreaTraSistemas')->nullable();
            // $table->text('TelefonoSistemas')->nullable();
            // $table->text('CorreoSistemas')->nullable();
            // $table->('itconcierges_id');
            $table->text('Latitude')->nullable();
            $table->text('Longitude')->nullable();
            $table->integer('RM')->nullable();
            $table->integer('ActivarCalificacion')->nullable();
            $table->integer('ActivarReportes')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
