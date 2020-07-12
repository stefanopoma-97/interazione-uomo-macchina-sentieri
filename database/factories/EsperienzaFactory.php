<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LibUser;
use App\Esperienza;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Esperienza::class, function (Faker $faker) {
    return [
        'commento' => $faker->sentence(rand(1,5)),
        'voto' => $faker->numberBetween(1, 10),
        'difficolta' => $faker->numberBetween(1, 10),
        //utente_id
        //sentiero_id
        'data' => $faker->date('Y-m-d', now())
        //revisore_id
        //'stato' => $faker->randomElement(['revisione', 'rifiutato', 'approvato'])
    ];
});
