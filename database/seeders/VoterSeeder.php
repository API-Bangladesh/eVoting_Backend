<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voters')->insert([
            [
                'id' => 1,
                'name' => 'Md. Rubel Hossain',
                'member_id' => '123456',
                'category' => 'member',
                'email_address' => 'emailtorubel@gmail.com',
                'contact_number' => '01676717945',
                'image' => Null,
                'is_online_voter' => 1,
                'is_checked_in' => Null,
            ],
            [
                'id' => 2,
                'name' => 'Md. Masud ',
                'member_id' => '654321',
                'category' => 'member',
                'email_address' => 'masud.ncse@gmail.com',
                'contact_number' => '01770520203',
                'image' => Null,
                'is_online_voter' => Null,
                'is_checked_in' => Null,
            ]
        ]);
    }
}
