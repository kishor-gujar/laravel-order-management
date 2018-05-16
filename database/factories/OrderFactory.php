<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $statuses = \App\Status::pluck('id')->toArray();
    return [
        'name' => $faker->name(),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'town' => $faker->word,
        'quantity' => $faker->numberBetween(1, 10),
        'price' => $faker->randomFloat(),
        'product' => $faker->randomElement(['TV', 'Car', 'Games', 'AC']),
        'specific' => $faker->word,
        'note' => $faker->sentence(),
        'status_id' => $faker->randomElement($statuses),
        'date' => $faker->dateTimeBetween('2018-1-1', '2018-12-30')
    ];
});




























