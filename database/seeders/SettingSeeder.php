<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'organization_name' => 'Advanced Project Integration Ltd.',
            'address' => 'House 04, Flat, 7A Rd #23/a, Dhaka 1213',
            'logo_type' => 'text-logo',
            'icon' => Null,
            'election_schedule_date' => now()->addDays(10),
            'election_interval' => '2',
            'application_submission_form' => json_encode([
                ['label' => 'Full Name', 'type' => 'text', 'name' => 'name', 'placeholder' => 'Enter your full name.', 'required' => 'true'],
                ['label' => 'Email Address', 'type' => 'email', 'name' => 'email', 'placeholder' => 'Enter a valid email address.', 'required' => 'true'],
                ['label' => 'Member ID', 'type' => 'text', 'name' => 'member_id', 'placeholder' => 'Enter a valid member id.', 'required' => 'true'],
                ['label' => 'Phone Number', 'type' => 'number', 'name' => 'phone', 'placeholder' => 'Enter your phone number.', 'required' => 'true']
            ]),
            'online_application_form_url' => Null,
            'online_voting_url' => Null,
            'election_year' => '2022',

            'voting_schedule_start_date' => now()->addDays(10),
            'voting_schedule_start_time' => '10:00:00',
            'voting_schedule_end_time' => '22:00:00',
            'application_subscription_start_date' => now()->subDays(1),
            'application_subscription_end_date' => now()->addDays(6),
            'ballot_merge_all' => 1,
            'officer_secret_code' => 123456,
            'lock_qr_code' => 0,
            'lock_online_token' => 0,

            'disable_common_users_login' => 0,
            'disable_voters_import' => 0,
            'disable_voters_deletion' => 0,
            'disable_permanently_voters_deletion' => 0,
            'offline_checked_in_status' => 1,
            'display_voting_result' => 1,
            'disable_offline_voting_result_upload' => 0,
            'enable_sms_gateway_service' => 0,
            'enable_voting_functions' => \App\Models\Setting::VFN_BOTH,
            'archive' => Null,

            'ballot_print' => 1,
            'print_code' => 'barcode',
            'position' => 'top-left',
            'orientation' => 'portrait',
            'paper_size' => 'a4',
            'width' => Null,
            'height' => Null,
            'max_limit' => 100,
        ]);
    }
}
