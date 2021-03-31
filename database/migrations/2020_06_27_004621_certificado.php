<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Certificado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->commit('codigo del certificado');
            $table->dateTime('fecha_entrega')->nullable()->commit('fecha de entrega del certificado');

            $table->unsignedBigInteger('participante_id')->nullable()->comment("clave foranea de participante");
            $table->foreign('participante_id')
                ->references('id')
                ->on('participante')
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
        Schema::dropIfExists('certificado');
    }
}
