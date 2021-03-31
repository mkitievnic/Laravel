<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('curso')->insert([
            ['codigo'=>'COMP','nombre' => 'Inducción a la Compañía', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MOD I','nombre' => 'Módulo I ', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MOD II','nombre' => 'Módulo II ', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MOD III','nombre' => 'Módulo III ', 'duracion'=>8, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MOD ADM','nombre' => 'Módulo Adm ', 'duracion'=>200, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'TRALT','nombre' => 'Trabajo Altura (1)', 'duracion'=>200, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MICF','nombre' => 'Manejo Integral - Cansancio y Fatiga', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'INVAC','nombre' => 'Investigación Accidentes', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'WECON','nombre' => 'Well Control', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'MONTA','nombre' => 'Montacarga', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'GRUA','nombre' => 'Grúa', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'LICABP','nombre' => 'Licencia Cat A / B / P', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'LICC','nombre' => 'Licencia Categoría C', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'LICT','nombre' => 'Licencia Categoría  T', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'CALF1','nombre' => 'Calificación Soldadores 1G, 2F, 3F ', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
            ['codigo'=>'CALS2','nombre' => 'Calificación Soldadores 2, 3, 4G', 'duracion'=>20, 'vencimiento' => 2, 'contenido'=>''],
        ]);
    }
}
