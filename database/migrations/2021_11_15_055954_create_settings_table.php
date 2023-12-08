<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name')->nullable();
            $table->text('address')->nullable();
            $table->text('logo_type')->nullable();
            $table->string('icon')->nullable();
            $table->date('election_schedule_date')->nullable();
            $table->tinyInteger('election_interval')->nullable();
            $table->json('application_submission_form')->nullable();
            $table->string('online_application_form_url')->nullable();
            $table->string('online_voting_url')->nullable();

            $table->year('election_year')->nullable();
            $table->date('voting_schedule_start_date')->nullable();
            $table->time('voting_schedule_start_time')->nullable();
            $table->time('voting_schedule_end_time')->nullable();
            $table->date('application_subscription_start_date')->nullable();
            $table->date('application_subscription_end_date')->nullable();
            $table->boolean('ballot_merge_all')->nullable();
            $table->integer('officer_secret_code')->nullable();
            $table->boolean('lock_qr_code')->nullable();
            $table->boolean('lock_online_token')->nullable();

            $table->boolean('disable_common_users_login')->nullable();
            $table->boolean('disable_voters_import')->nullable();
            $table->boolean('disable_voters_deletion')->nullable();
            $table->boolean('disable_permanently_voters_deletion')->nullable();
            $table->boolean('offline_checked_in_status')->nullable();
            $table->boolean('display_voting_result')->nullable();
            $table->boolean('disable_offline_voting_result_upload')->nullable();
            $table->boolean('enable_sms_gateway_service')->nullable();
            $table->boolean('enable_voting_functions')->nullable();
            $table->boolean('archive')->nullable();

            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('aws_access_key')->nullable();
            $table->string('aws_secret_key')->nullable();
            $table->string('aws_region')->nullable();

            $table->string('api_token_sslwireless')->nullable();
            $table->string('domain_sslwireless')->nullable();
            $table->string('sid_sslwireless')->nullable();

            $table->string('ballot_print')->nullable();
            $table->string('print_code')->nullable();
            $table->string('position')->nullable();
            $table->string('orientation')->nullable();
            $table->string('paper_size')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('max_limit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
