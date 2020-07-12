<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LibUser;
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

$factory->define(LibUser::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cognome' => $faker->lastName,
        'username' => $faker->unique()->sentence(1),
        'mail' => $faker->unique()->safeEmail,
        'password' => md5('pomapoma'), // password
        //citta_id
        'admin' => 'n',
        'descrizione' => $faker->sentence(rand(1,5)),
        'consiglio_password' => 'è pomapoma'
    ];
});
