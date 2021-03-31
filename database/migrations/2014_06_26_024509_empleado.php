<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->integer('legajo')->unique()->comment("numero de legajo");
            $table->string('ci', 15)->comment("ci del empleado");
            $table->string('expedido', 2)->comment("expedido del ci del empleado");
            $table->string('nombre', 30)->comment("nombre del empleado");
            $table->string('apellido_paterno', 20)->comment("pellido_paterno del empleado");
            $table->string('apellido_materno', 20)->nullable()->comment("pellido_materno del empleado");
            $table->date('fecha_nacimiento')->commnet("fecha de nacimiento del empleado");
            $table->string('email')->unique();
            $table->string('telefono', 30)->unique()->commnet("telefono del empleado");
            $table->string('foto')->nullable()->comment("foto del empleado");

            $table->unsignedBigInteger('funcion_id')->nullable()->comment("clave foranea de funcion");
            $table->foreign('funcion_id')
                ->references('id')
                ->on('funcion')
                ->onDelete('cascade');

            $table->unsignedBigInteger('proveedor_id')->nullable()->comment("clave foranea de proveedor");
            $table->foreign('proveedor_id')
                ->references('id')
                ->on('proveedor');

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
        Schema::dropIfExists('empleado');
    }
}
