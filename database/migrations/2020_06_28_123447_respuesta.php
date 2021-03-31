<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Respuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha")->comment("fecha y hora de la respuesta");
            $table->string("letra", 2)->comment("letra de la respuesta");
            $table->boolean("es_correcto")->default(false)->comment("true si la respuesta correcta");

            $table->unsignedBigInteger('participante_id')->nullable()->comment("clave foranea de participante");
            $table->foreign('participante_id')
                ->references('id')
                ->on('participante')
                ->onDelete('cascade');

            $table->unsignedBigInteger('pregunta_id')->nullable()->comment("clave foranea de pregunta");
            $table->foreign('pregunta_id')
                ->references('id')
                ->on('pregunta')
                ->onDelete('cascade');

            $table->unsignedBigInteger('examen_id')->nullable()->comment("clave foranea de examen");
            $table->foreign('examen_id')
                ->references('id')
                ->on('examen')
                ->onDelete('cascade');

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
        Schema::dropIfExists('respuesta');
    }
}
