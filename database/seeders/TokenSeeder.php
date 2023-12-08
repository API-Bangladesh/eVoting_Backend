<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tokens')->insert([
            [
                'id' => 1,
                'voter_id' => 1,
                'token' => Str::upper(Str::random(6)),
                'is_used' => Null,
                'is_sent_email' => Null,
            ]
        ]);
    }
}
