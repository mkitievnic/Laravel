<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiaFranco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_franco', function (Blueprint $table) {
            $table->id();
            $table->date("fecha")->comment("dia de frando");

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
        Schema::dropIfExists('dia_franco');
    }
}
