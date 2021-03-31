<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Curso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->comment("nombre del curso");
            $table->string('nombre', 150)->comment("nombre del curso");
            $table->integer('duracion')->comment("duracion en horas u horas academicas");
            $table->integer("vencimiento")->nullable()->comment("vencimiento en anios del curso");
            $table->text("contenido")->nullable()->comment("contenido del curso");
            $table->boolean("estado")->default(true)->comment("estado del curso");

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
        Schema::dropIfExists('curso');
    }
}
