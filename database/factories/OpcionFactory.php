<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Opcion;
use Faker\Generator as Faker;

$factory->define(Opcion::class, function (Faker $faker) {

    return [
        'letra' => $faker->word,
        'respuesta' => $faker->text,
        'es_correcto' => $faker->word,
        'pregunta_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
