<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counter_officers')->insert([
            [
                'id' => 1,
                'name' => 'Md. Sadek',
                'info' => 'He is honest.',
            ]
        ]);
    }
}
