<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Empleado;
use Faker\Generator as Faker;

$factory->define(Empleado::class, function (Faker $faker) {

    return [
        'legajo' => $faker->unique()->numberBetween(100, 999999),
        'ci' => $faker->numberBetween(100000, 999999),
        'expedido' => $faker->randomElement(array("SC",
            "LP",
            "CB",
            "OR",
            "CH",
            "PT",
            "TJ",
            "BE",
            "PD")),
        'nombre' => $faker->firstName,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'fecha_nacimiento' => $faker->dateTimeBetween('1970-01-01', '2000-01-01', 'America/La_Paz'),
        'email' => $faker->unique()->email,
        'telefono'=> $faker->phoneNumber,
        'foto' => 'foto_base.png',
        'funcion_id' => $faker->numberBetween(1, 50),
        'proveedor_id' => $faker->numberBetween(1, 3),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
