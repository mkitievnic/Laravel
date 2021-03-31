<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreguntasFrecuentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_frecuente', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta', 150)->comment("pregunta frecuente");
            $table->text("respuesta")->comment("respuesta a la pregunta frecuente");

            $table->unsignedBigInteger('usuario_id')->nullable()->comment("clave foranea de usuario");
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuario');

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
        Schema::dropIfExists('pregunta_frecuente');
    }
}
