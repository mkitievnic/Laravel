<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Evento;
use Faker\Generator as Faker;

$factory->define(Evento::class, function (Faker $faker) {

    return [
        'fecha_inicial' => $faker->word,
        'fecha_final' => $faker->word,
        'hora_inicial' => $faker->word,
        'hora_final' => $faker->word,
        'direccion' => $faker->word,
        'esta_abierto' => $faker->word,
        'curso_funcion_id' => $faker->word,
        'usuario_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
