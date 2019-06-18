<?php

use App\Saved;
use Faker\Generator as Faker;

$factory->define(Saved::class, function (Faker $faker) {
    return [
        'json' => json_encode([
            [
                'id' => 1,
                'rule' => 'required|string',
                'value' => $faker->word,
                'disabled' => $faker->randomElement([true, false]),
            ],
        ]),
        'ip' => $faker->ipv4,
    ];
});
