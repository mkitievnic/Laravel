<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Opcione extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion', function (Blueprint $table) {
            $table->id();
            $table->string("letra", 2)->comment("letra de la opcion");
            $table->text("respuesta")->comment("respuesta de la opcion");
            $table->boolean("es_correcto")->default(false)->comment("true la respuesta correcta");

            $table->unsignedBigInteger('pregunta_id')->nullable()->comment("clave foranea de pregunta");
            $table->foreign('pregunta_id')
                ->references('id')
                ->on('pregunta')
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
        Schema::dropIfExists('opcion');
    }
}
