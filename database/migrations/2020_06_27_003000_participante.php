<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Participante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante', function (Blueprint $table) {
            $table->id();

            $table->double('examen')->nullable()->commnet('calificacion optenida');
            $table->double('final')->nullable()->commnet('calificacion optenida');
            $table->integer("gestion")->comment("gestion de la participacion");
            $table->boolean("es_seleccionado")->default(false)->comment("si el participante esta seleccionado para el envio de material, examen, etc");

            $table->unsignedBigInteger('evento_id')->nullable()->comment("clave foranea de evento");
            $table->foreign('evento_id')
                ->references('id')
                ->on('evento')
                ->onDelete('cascade');

            $table->unsignedBigInteger('empleado_id')->nullable()->comment("clave foranea de empleado");
            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleado')
                ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('participante');
    }
}
