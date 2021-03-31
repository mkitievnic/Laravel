<?php

use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('empleado')->insert([
            "legajo" => 123,
            "ci" => "5094392",
            "expedido" => "OR",
            "nombre" => "Juan Pablo",
            "apellido_paterno" => "Cabero",
            "apellido_materno" => "Carrasco",
            "fecha_nacimiento" => "1989-01-01",
            "email" => "luas0_1@yahoo.es",
            "telefono" => "76137269",
            "foto" => null,
            "funcion_id" => 1,
            "proveedor_id" => 1
        ]);

        //factory(\App\Models\Empleado::class, 50)->create();
    }
}
