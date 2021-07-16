<?php

use Faker\Generator as Faker;
use VCComponent\Laravel\Language\Entities\Language;
use VCComponent\Laravel\Language\Entities\Languageable;

$factory->define(Language::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(1, 1), true),
        'code' => $faker->words(rand(1, 1), true),
    ];
});

$factory->define(Languageable::class, function (Faker $faker) {
    return [
        'languageable_type' => $faker->randomElement(['categories', 'item_menus', 'options', 'posts', 'products']),
        'languageable_id' => 1,
        'language_id' => 1,
        'field' => $faker->words(rand(1, 1), true),
        'value' => $faker->words(rand(4, 7), true),
    ];
});
