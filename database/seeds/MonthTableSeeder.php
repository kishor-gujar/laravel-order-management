<?php

use Illuminate\Database\Seeder;

class MonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        foreach ($months as $month){
            DB::table('months')->insert([ //,
                'name' => $month,
                'status' => $faker->boolean()
            ]);
        }

    }
}
