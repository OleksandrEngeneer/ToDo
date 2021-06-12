<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    
    do {
        $name = $faker->unique()->word();
    } while (\strlen($name) < rand(6,9));
    
    return [
        'name' => $name,
        'slug' => $name,
    ];

});
