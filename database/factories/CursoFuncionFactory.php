<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CursoFuncion;
use Faker\Generator as Faker;

$factory->define(CursoFuncion::class, function (Faker $faker) {

    return [
        'alta' => $faker->word,
        'curso_id' => $faker->word,
        'funcion_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
