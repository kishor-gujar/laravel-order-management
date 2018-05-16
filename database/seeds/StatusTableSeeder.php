<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statues = ['Confirmed', 'Shipped', 'Delivered', 'Returned', 'Canceled'];
        foreach ($statues as $stats){
            DB::table('statuses')->insert([ //,
                'name' => $stats
            ]);
        }
    }
}
