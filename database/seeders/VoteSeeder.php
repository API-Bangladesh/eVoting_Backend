<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votes')->insert([
            [
                'id' => 1,
                'candidate_ids' => json_encode([1, 3, 4])
            ],
            [
                'id' => 2,
                'candidate_ids' => json_encode([2, 4, 5])
            ],
            [
                'id' => 3,
                'candidate_ids' => json_encode([1, 3, 5])
            ],
            [
                'id' => 4,
                'candidate_ids' => json_encode([2, 4, 5])
            ],
            [
                'id' => 5,
                'candidate_ids' => json_encode([2, 3, 5])
            ]
        ]);
    }
}
