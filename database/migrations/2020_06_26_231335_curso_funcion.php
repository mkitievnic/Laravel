<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CursoFuncion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_funcion', function (Blueprint $table) {
            $table->id();
            $table->integer("gestion")->comment("gestion de la matriz funcion");

            $table->unsignedBigInteger('curso_id')->comment("clave foranea de curso");
            $table->foreign('curso_id')
                ->references('id')
                ->on('curso');

            $table->unsignedBigInteger('funcion_id')->comment("clave foranea de funcion");
            $table->foreign('funcion_id')
                ->references('id')
                ->on('funcion');

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
        Schema::dropIfExists('curso_funcion');
    }
}
