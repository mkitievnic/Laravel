<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Funcion;
use Faker\Generator as Faker;

$factory->define(Funcion::class, function (Faker $faker) {

    return [
        'nombre' => $faker->word,
        'sector_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
