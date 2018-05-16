<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(MonthTableSeeder::class);
        factory(\App\Order::class, 50)->create();
//
    }
}
