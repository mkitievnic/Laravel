<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'email' => $faker->unique()->email,
        'password' => \Illuminate\Support\Facades\Hash::make("123456"),
        'nivel' => $faker->randomElement(\App\Patrones\Fachada::getRoles()),
        'alta' => false,
        'persona_id' => $faker->unique()->numberBetween(2, 51),
        'persona_type' => 'App\Models\Empleado',
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
