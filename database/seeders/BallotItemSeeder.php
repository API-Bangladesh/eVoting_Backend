<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BallotItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ballot_items')->insert([
            [
                'id' => 1,
                'ballot_id' => 1,
                'candidate_id' => 1,
            ],
            [
                'id' => 2,
                'ballot_id' => 1,
                'candidate_id' => 2,
            ],
            [
                'id' => 3,
                'ballot_id' => 2,
                'candidate_id' => 3,
            ],
            [
                'id' => 4,
                'ballot_id' => 2,
                'candidate_id' => 4,
            ],
            [
                'id' => 5,
                'ballot_id' => 2,
                'candidate_id' => 5,
            ]
        ]);
    }
}
