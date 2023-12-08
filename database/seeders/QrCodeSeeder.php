<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qr_codes')->insert([
            [
                'id' => 1,
                'code' => Str::upper(Str::random(6)),
                'is_used' => Null,
                'scan_blank_ballot' => Null,
                'scan_voted_ballot' => Null,
                'validated_by' => Null,
                'verified_by' => Null,
            ]
        ]);
    }
}
