<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $statuses = config('todo.statuses');

    return [
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'body' => $faker->sentence(rand(9,11)),
        'status' => $statuses[\rand(0,count($statuses)-1)],
        'deadline' => $faker->dateTimeThisMonth('+12 days')->format('Y-m-d'),
    ];
});
