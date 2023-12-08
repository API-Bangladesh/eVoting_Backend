<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BallotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ballots')->insert([
            [
                'id' => 1,
                'position_id' => 1,
                'vote_limit' => 1,
            ],
            [
                'id' => 2,
                'position_id' => 2,
                'vote_limit' => 2,
            ]
        ]);
    }
}
