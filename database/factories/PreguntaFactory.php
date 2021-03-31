<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pregunta;
use Faker\Generator as Faker;

$factory->define(Pregunta::class, function (Faker $faker) {

    return [
        'pregunta' => $faker->text,
        'url_imagen' => $faker->word,
        'curso_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
