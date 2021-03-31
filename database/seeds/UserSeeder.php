<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('usuario')->insert([
            [
                "email" => "admin@sanantonio.com",
                "password" => \Illuminate\Support\Facades\Hash::make("123456"),
                "nivel" => \App\Patrones\Rol::Administrador,
                "persona_id" => 1,
                "alta" => true,
                "persona_type" => "App\Models\Empleado"
            ],
//            [
//                "email" => "profesor1@yahoo.es",
//                "password" => \Illuminate\Support\Facades\Hash::make("123456"),
//                "nivel" => \App\Patrones\Rol::Medio,
//                "persona_id" => 1,
//                "alta" => true,
//                "persona_type" => "App\Models\Instructor"
//            ],
//            [
//                "email" => "profesor2@yahoo.es",
//                "password" => \Illuminate\Support\Facades\Hash::make("123456"),
//                "nivel" => \App\Patrones\Rol::Medio,
//                "persona_id" => 2,
//                "alta" => true,
//                "persona_type" => "App\Models\Instructor"
//            ],
        ]);

        //factory(\App\User::class, 50)->create();
    }
}
