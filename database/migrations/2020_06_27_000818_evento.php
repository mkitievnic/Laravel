<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicial')->comment("fecha de inicio del evento");
            $table->date('fecha_final')->comment("fecha de final del evento");
            $table->time('hora_inicial')->nullable()->comment("hora inicial del evento");
            $table->time('hora_final')->nullable()->comment("hora final del evento");
            $table->date('fecha_caducidad')->comment("fecha que caduca el evento");
            $table->string('direccion')->nullable()->comment("direccion donde se va a realizar el evento");
            $table->text("informe")->nullable()->comment("informe del instructor");
            $table->enum('estado', \App\Patrones\Fachada::getEstadoEventos())->comment("fecha de final del evento");

            $table->unsignedBigInteger('curso_id')->comment("clave foranea de curso");
            $table->foreign('curso_id')
                ->references('id')
                ->on('curso');

            $table->unsignedBigInteger('usuario_id')->comment("clave foranea de usuario");
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
        Schema::dropIfExists('evento');
    }
}
