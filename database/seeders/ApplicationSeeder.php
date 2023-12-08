<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'id' => 1,
                'voter_id' => 1,
                'form_data' => json_encode([
                    'name' => 'Md. Rubel Hossain',
                    'email' => 'rubel@gmail.com',
                    'member_id' => '123456',
                    'phone' => '01676717945',
                ]),
                'is_approved' => 1,
                'is_declined' => Null,
                'declined_reason' => Null
            ]
        ]);
    }
}
