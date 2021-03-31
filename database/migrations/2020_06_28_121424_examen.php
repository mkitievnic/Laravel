<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Examen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha_inicial")->comment("fecha y hora de inicio del examen");
            $table->dateTime("fecha_final")->comment("fecha y hora del fin del examen");
            $table->string("descripcion")->comment("descripcion del examen");
            $table->double("tiempo")->nullable()->comment("tiempo en minutos");
            $table->boolean("estado")->default(false)->commnet("si el examen esta o no liberado");

            $table->unsignedBigInteger('evento_id')->nullable()->comment("clave foranea de evento");
            $table->foreign('evento_id')
                ->references('id')
                ->on('evento')
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
        Schema::dropIfExists('examen');
    }
}
