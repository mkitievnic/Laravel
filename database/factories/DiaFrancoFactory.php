<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DiaFranco;
use Faker\Generator as Faker;

$factory->define(DiaFranco::class, function (Faker $faker) {

    return [
        'fecha' => $faker->word,
        'empleado_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
