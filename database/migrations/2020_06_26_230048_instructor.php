<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Instructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor', function (Blueprint $table) {
            $table->id();
            $table->string('ci', 15)->comment("ci del instructor");
            $table->string('expedido', 2)->comment("expedido del ci del instructor");
            $table->string('nombre', 30)->comment("nombre del instructor");
            $table->string('apellido_paterno', 20)->comment("pellido_paterno del instructor");
            $table->string('apellido_materno', 20)->nullable()->comment("pellido_materno del instructor");
            $table->string('email')->unique();
            $table->string('telefono', 30)->unique()->commnet("telefono del empleado");

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
        Schema::dropIfExists('instructor');
    }
}
