<?php

namespace App\Providers;

use App\Facades\Setting;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return bool|void
     */
    public function boot()
    {
        try {

            // App
            config(['app.name' => Setting::get('organization_name') ?? config('app.name')]);
            config(['app.online_application_form_url' => Setting::get('online_application_form_url') ?? config('app.online_application_form_url')]);
            config(['app.online_voting_url' => Setting::get('online_voting_url') ?? config('app.online_voting_url')]);

            // Mail - SMTP
            config(['mail.default' => Setting::get('mail_mailer') ?? config('mail.default')]);
            config(['mail.mailers.smtp.host' => Setting::get('mail_host') ?? config('mail.mailers.smtp.host')]);
            config(['mail.mailers.smtp.port' => Setting::get('mail_port') ?? config('mail.mailers.smtp.port')]);
            config(['mail.mailers.smtp.encryption' => Setting::get('mail_encryption') ?? config('mail.mailers.smtp.encryption')]);
            config(['mail.mailers.smtp.username' => Setting::get('mail_username') ?? config('mail.mailers.smtp.username')]);
            config(['mail.mailers.smtp.password' => Setting::get('mail_password') ?? config('mail.mailers.smtp.password')]);

            // Mail - Common
            config(['mail.from.address' => Setting::get('mail_from_address') ?? config('mail.from.address')]);
            config(['mail.from.name' => Setting::get('mail_from_name') ?? config('mail.from.name')]);

            // Mail - SES
            config(['services.ses.key' => Setting::get('aws_access_key') ?? config('services.ses.key')]);
            config(['services.ses.secret' => Setting::get('aws_secret_key') ?? config('services.ses.secret')]);
            config(['mail.from.region' => Setting::get('aws_region') ?? config('mail.from.region')]);

            // SMS - SSLWIRELESS
            config(['smssslwireless.api_token' => Setting::get('api_token_sslwireless') ?? config('smssslwireless.api_token')]);
            config(['smssslwireless.domain' => Setting::get('domain_sslwireless') ?? config('smssslwireless.domain')]);
            config(['smssslwireless.sid' => Setting::get('sid_sslwireless') ?? config('smssslwireless.sid')]);
        } catch (\Exception $exception) {
            report($exception);
        }
    }
}
