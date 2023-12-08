<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidates')->insert([
            [
                'id' => 1,
                'name' => 'Md. Masudul Kabir',
                'icon' => Null,
                'counter' => Null,
            ],
            [
                'id' => 2,
                'name' => 'Abdul Kayum',
                'icon' => Null,
                'counter' => Null,
            ],
            [
                'id' => 3,
                'name' => 'Kawsar Ibn Siraj',
                'icon' => Null,
                'counter' => Null,
            ],
            [
                'id' => 4,
                'name' => 'Jiaur Rahman',
                'icon' => Null,
                'counter' => Null,
            ],
            [
                'id' => 5,
                'name' => 'Sadek Hossain',
                'icon' => Null,
                'counter' => Null,
            ],
        ]);
    }
}
