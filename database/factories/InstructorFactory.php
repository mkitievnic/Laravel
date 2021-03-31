<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Instructor;
use Faker\Generator as Faker;

$factory->define(Instructor::class, function (Faker $faker) {

    return [
        'ci' => $faker->word,
        'expedido' => $faker->word,
        'nombre' => $faker->word,
        'apellido_paterno' => $faker->word,
        'apellido_materno' => $faker->word,
        'tipo' => $faker->word,
        'alta' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
