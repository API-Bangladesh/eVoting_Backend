<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'username'=>'superadmin',
                'email' => 'superadmin@demo.com',
                'password' => bcrypt('123456'),
                'counter_officer_id' => Null,
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'username'=>'admin',
                'email' => 'admin@demo.com',
                'password' => bcrypt('123456'),
                'counter_officer_id' => Null,
            ],
            [
                'id' => 3,
                'name' => 'Officer',
                'username'=>'officer',
                'email' => 'officer@demo.com',
                'password' => bcrypt('123456'),
                'counter_officer_id' => 1,
            ]
        ]);
    }
}
