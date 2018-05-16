<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $statuses = \App\Status::pluck('id')->toArray();
    $status = ['Confirmed', 'Shipped', 'Delivered', 'Returned', 'Canceled'];
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
//        'status' => $faker->randomElement($status),
        'status_id' => $faker->randomElement($statuses),
        'date' => $faker->date()
    ];
});




























