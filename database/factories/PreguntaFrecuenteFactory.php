<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PreguntaFrecuente;
use Faker\Generator as Faker;

$factory->define(PreguntaFrecuente::class, function (Faker $faker) {

    return [
        'pregunta' => $faker->word,
        'respuesta' => $faker->word,
        'usuario_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
