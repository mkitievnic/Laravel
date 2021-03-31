<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Participante;
use Faker\Generator as Faker;

$factory->define(Participante::class, function (Faker $faker) {

    return [
        'asistencia' => $faker->randomDigitNotNull,
        'examen' => $faker->randomDigitNotNull,
        'final' => $faker->randomDigitNotNull,
        'gestion' => $faker->randomDigitNotNull,
        'evento_id' => $faker->word,
        'empleado_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
