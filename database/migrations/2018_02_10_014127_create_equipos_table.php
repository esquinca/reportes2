<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MAC', 45);
            $table->string('Serie', 45);
            $table->date('Fecha_Registro');
            $table->date('Fecha_Baja');
            // $table->timestamp('Fecha_Baja'); /NO SE DEJA
            $table->string('Descripcion');
            $table->string('Nombre_Grupo');
            $table->string('Nombre_GrupoRecepcion');
            $table->string('FechaInicioC');
            $table->string('FechaTerminoC');
            //Primera llave foranea
            $table->integer('modelos_id')->unsigned();
            $table->foreign('modelos_id')->references('id')->on('modelos');
            //Segunda llave foranea
            $table->integer('marcas_id')->unsigned();
            $table->foreign('marcas_id')->references('id')->on('marcas');
            //Tercera llave foranea
            $table->integer('estados_id')->unsigned();
            $table->foreign('estados_id')->references('id')->on('estados');
            //Cuarta llave foranea
            $table->integer('check_it_id')->unsigned();
            $table->foreign('check_it_id')->references('id')->on('check_it_status');
            //Quinta llave foranea
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels');
            //Sexta llave foranea
            $table->integer('especificacions_id')->unsigned();
            $table->foreign('especificacions_id')->references('id')->on('especificacions');
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
        Schema::dropIfExists('equipos');
    }
}
