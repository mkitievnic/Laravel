<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('nivel', \App\Patrones\Fachada::getRoles())->nullable();
            $table->boolean('alta')->default(false)->comment("si el usuario esta dado de alta");
            $table->rememberToken();

            //relaciones polimorficas para los fk multiples, pero que almacenen un valor a la vez
            $table->unsignedInteger('persona_id')->comment("clave foranea de empleado o instructor");
            $table->string('persona_type')->comment("Modelo para referenciar al origen del usuario");

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
        Schema::dropIfExists('users');
    }
}
