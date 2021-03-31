<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Examen;
use Faker\Generator as Faker;

$factory->define(Examen::class, function (Faker $faker) {

    return [
        'fecha_inicial' => $faker->date('Y-m-d H:i:s'),
        'descripcion' => $faker->word,
        'tiempo' => $faker->randomDigitNotNull,
        'estado' => $faker->word,
        'evento_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'fecha_final' => $faker->date('Y-m-d H:i:s')
    ];
});
