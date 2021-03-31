<?php

use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('proveedor')->insert([
            ['nombre' => 'San Antonio'],
//            ['nombre' => 'Proveedor 1'],
//            ['nombre' => 'Proveedor 2'],
        ]);
    }
}
