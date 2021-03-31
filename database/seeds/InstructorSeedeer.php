<?php

use Illuminate\Database\Seeder;

class InstructorSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('instructor')->insert([
            "ci" => "4321234",
            "expedido" => "LP",
            "nombre" => "LIDIA",
            "apellido_paterno" => "MARCE",
            "apellido_materno" => "PACHECO",
            "email" => "lidia@yahoo.es",
            "telefono" => "7613769",
            "proveedor_id" => 2,
        ]);

        \DB::table('instructor')->insert([
            "ci" => "767878",
            "expedido" => "OR",
            "nombre" => "PEDRO",
            "apellido_paterno" => "MARCE",
            "apellido_materno" => "MORALES",
            "email" => "pedro@yahoo.es",
            "telefono" => "6465789",
            "proveedor_id" => 3,
        ]);
    }
}
