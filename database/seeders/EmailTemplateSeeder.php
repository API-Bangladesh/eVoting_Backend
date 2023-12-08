<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->insert([
            [
                'id' => 1,
                'category_id' => EmailTemplate::ONLINE_APPLICATION_FORM,
                'receiver_type_id' => Null,
                'subject' => 'Online Application Form',
                'body' => 'Please Visit the url for online vote approval',
                'sms' => 'Please Visit the url for online vote approval',
            ],
            [
                'id' => 2,
                'category_id' => EmailTemplate::ONLINE_VOTING_INVITATION,
                'receiver_type_id' => Null,
                'subject' => 'Online Vote Casting Invitation',
                'body' => 'Please Visit the url for online vote Cast',
                'sms' => 'Please Visit the url for online vote Cast',
            ],
        ]);
    }
}
