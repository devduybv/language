<?php

use Faker\Generator as Faker;
use VCComponent\Laravel\Language\Entities\Label;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['home', 'about', 'paginate']),
        'key' => $faker->unique()->words(rand(1, 1), true),
        'value' => $faker->words(rand(4, 7), true),
    ];
});
