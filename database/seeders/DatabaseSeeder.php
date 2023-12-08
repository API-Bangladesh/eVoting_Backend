<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CounterOfficerSeeder::class,
            CounterSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            PermissionDemoSeeder::class,
            VoterSeeder::class,
            PositionSeeder::class,
            CandidateSeeder::class,
            BallotSeeder::class,
            BallotItemSeeder::class,
            QrCodeSeeder::class,
            TokenSeeder::class,
            VoteSeeder::class,
            ApplicationSeeder::class,
            SettingSeeder::class,
            EmailTemplateSeeder::class,
        ]);
    }
}
