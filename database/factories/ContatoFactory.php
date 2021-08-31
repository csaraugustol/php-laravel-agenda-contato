<?php

use Faker\Generator as Faker;

$factory->define(App\Contato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'user_id' => 1
    ];
});

