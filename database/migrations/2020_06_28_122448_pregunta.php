<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pregunta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->id();
            $table->text("pregunta")->comment("descripcion de la pregunta");
            $table->boolean("estado")->default(true)->comment("estado del curso");

            $table->unsignedBigInteger('curso_id')->nullable()->comment("clave foranea de curso");
            $table->foreign('curso_id')
                ->references('id')
                ->on('curso')
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
        Schema::dropIfExists('pregunta');
    }
}
