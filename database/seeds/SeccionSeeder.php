<?php

use Illuminate\Database\Seeder;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sector')->insert([
            ['nombre' => 'Operaciones (RIGS)'],
            ['nombre' => 'Logística / Transporte'],
            ['nombre' => 'Ingeniería & Mantenimiento'],
            ['nombre' => 'Sector / QHSE'],
            ['nombre' => 'Compras'],
            ['nombre' => 'Almacén - Depósito'],
            ['nombre' => 'Comercial'],
            ['nombre' => 'Operaciones de Servicios'],
            ['nombre' => 'RRHH'],
            ['nombre' => 'Administración'],
        ]);
    }
}
