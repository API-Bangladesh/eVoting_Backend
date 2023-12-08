<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counters')->insert([
            [
                'id' => 1,
                'counter_number' => '301',
                'counter_name' => 'East Corner',
                'counter_officer_id' => 1,
            ]
        ]);
    }
}
