<?php

use Illuminate\Database\Seeder;

class FuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('funcion')->insert([
            ['nombre' => 'Gerente de Operaciones Rigs', 'sector_id'=>1],
            ['nombre' => 'Jefe de Campo ', 'sector_id'=>1],
            ['nombre' => 'Jefe de Equipo ', 'sector_id'=>1],
            ['nombre' => 'Encargado Turno', 'sector_id'=>1],
            ['nombre' => 'Perforador ', 'sector_id'=>1],
            ['nombre' => 'Enganchador', 'sector_id'=>1],
            ['nombre' => 'ABP', 'sector_id'=>1],
            ['nombre' => 'Administrador De Campamento ', 'sector_id'=>1],
            ['nombre' => 'Encargado de Base', 'sector_id'=>1],
            ['nombre' => 'Radio Operador', 'sector_id'=>1],
            ['nombre' => 'Jefe de Transporte', 'sector_id'=>2],
            ['nombre' => 'Operador De Grúa', 'sector_id'=>2],
            ['nombre' => 'Operador De Pala', 'sector_id'=>2],
            ['nombre' => 'Chofer Flota Pesada', 'sector_id'=>2],
            ['nombre' => 'Mecánico Flota Pesada', 'sector_id'=>2],
            ['nombre' => 'Jefe de Ingeniería y Mantenimiento', 'sector_id'=>3],
            ['nombre' => 'Ingeniero De Equipos', 'sector_id'=>3],
            ['nombre' => 'Enc. Mant.Eléctrico', 'sector_id'=>3],
            ['nombre' => 'Auxiliar De Mantenimiento', 'sector_id'=>3],
            ['nombre' => 'Mecánico / Top Drive / Herramientas', 'sector_id'=>3],
            ['nombre' => 'Encargado de BOP', 'sector_id'=>3],
            ['nombre' => 'Soldador', 'sector_id'=>3],
            ['nombre' => 'Electricista ', 'sector_id'=>3],
            ['nombre' => 'Motorista', 'sector_id'=>3],
            ['nombre' => 'Encargado QHSE', 'sector_id'=>4],
            ['nombre' => 'Coordinador QHSE', 'sector_id'=>4],
            ['nombre' => 'Monitor QHSE', 'sector_id'=>4],
            ['nombre' => 'Jefe de Compras y Almacenes', 'sector_id'=>5],
            ['nombre' => 'Asistente Compras', 'sector_id'=>5],
            ['nombre' => 'Auxiliar De Almacenes', 'sector_id'=>6],
            ['nombre' => 'Jefe de Facturación', 'sector_id'=>7],
            ['nombre' => 'Gerente De Operaciones E&P', 'sector_id'=>8],
            ['nombre' => 'Asistente De Operaciones', 'sector_id'=>8],
            ['nombre' => 'Ingeniero De Operaciones De Coiled Tubing', 'sector_id'=>8],
            ['nombre' => 'Supervisor De Coiled Tubing', 'sector_id'=>8],
            ['nombre' => 'Supervisor De Herramientas De Pesca Y Ensayo', 'sector_id'=>8],
            ['nombre' => 'Supervisor De Mantenimiento', 'sector_id'=>8],
            ['nombre' => 'Asistente De Herramientas', 'sector_id'=>8],
            ['nombre' => 'Operador De Bomba', 'sector_id'=>8],
            ['nombre' => 'Operador De Coiled Tubing', 'sector_id'=>8],
            ['nombre' => 'Operador De Nitrógeno', 'sector_id'=>8],
            ['nombre' => 'Chofer', 'sector_id'=>8],
            ['nombre' => 'Mecánico Herramientas', 'sector_id'=>8],
            ['nombre' => 'Soldador', 'sector_id'=>8],
            ['nombre' => 'Gerente De RRHH', 'sector_id'=>9],
            ['nombre' => 'Asistente RRHH', 'sector_id'=>9],
            ['nombre' => 'Medico De Base', 'sector_id'=>9],
            ['nombre' => 'Gerente Administrativo', 'sector_id'=>10],
            ['nombre' => 'Auxiliar Administrativa (Tesorera)', 'sector_id'=>10],
            ['nombre' => 'Auxiliar Administrativo', 'sector_id'=>10],

        ]);
    }
}
