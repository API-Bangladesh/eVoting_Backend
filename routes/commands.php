<?php

use App\Facades\Setting;
use App\Models\Candidate;
use App\Models\Role;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/**
 * queue:work
 */
Route::get('command/queue:work', function () {
    try {
        Artisan::call('queue:work --stop-when-empty', []);
    } catch (\Exception $exception) {
        throw $exception;
    }

    echo "Queue work is running.";
});

/**
 * schedule:work
 */
Route::get('command/schedule:work', function () {
    try {
        Artisan::call('schedule:work');
    } catch (\Exception $exception) {
        throw $exception;
    }

    echo "Schedule work is running.";
});

/**
 * storage:link
 */
Route::get('command/storage:link', function () {
    try {
        Artisan::call('storage:link');
    } catch (\Exception $exception) {
        throw $exception;
    }

    echo "Storage file is created.";
});

/**
 * cache:clear
 */
Route::get('command/cache:clear', function () {
    try {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        Artisan::call('route:clear');
    } catch (\Exception $exception) {
        throw $exception;
    }

    echo "Cache is cleaned.";
});

/**
 * db-clean
 */
Route::get('command/db:clean', function () {
    Gate::authorize('db-clean settings');

    try {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Voter::withTrashed()->get()->map(function ($voter) {
            remove_file($voter->image);
            $voter->forceDelete();
        });
        User::get()->map(function ($user) {
            if ($user->hasRole(Role::TYPE_OFFICER)) {
                remove_file($user->image);
                $user->forceDelete();
            }
        });
        Candidate::get()->map(function ($candidate) {
            remove_file($candidate->icon);
            $candidate->forceDelete();
        });

        DB::table('activity_log')->truncate();
        DB::table('applications')->truncate();
        DB::table('archives')->truncate();
        DB::table('ballots')->truncate();
        DB::table('ballot_items')->truncate();
        DB::table('positions')->truncate();
        DB::table('candidates')->truncate();
        DB::table('counters')->truncate();
        DB::table('counter_officers')->truncate();
        DB::table('email_templates')->truncate();
        DB::table('jobs')->truncate();
        DB::table('failed_jobs')->truncate();
        DB::table('offline_tokens')->truncate();
        DB::table('qr_codes')->truncate();
        DB::table('tokens')->truncate();
        DB::table('voters')->truncate();
        DB::table('votes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Setting::put('election_schedule_date', NULL);
        Setting::put('election_interval', NULL);
        Setting::put('election_year', NULL);
        Setting::put('voting_schedule_start_date', NULL);
        Setting::put('voting_schedule_start_time', NULL);
        Setting::put('voting_schedule_end_time', NULL);
        Setting::put('application_subscription_start_date', NULL);
        Setting::put('application_subscription_end_date', NULL);
        Setting::put('lock_qr_code', 0);
        Setting::put('lock_online_token', 0);
        Setting::put('disable_common_users_login', 0);
        Setting::put('disable_voters_import', 0);
        Setting::put('disable_voters_deletion', 0);
        Setting::put('disable_permanently_voters_deletion', 0);
        Setting::put('display_voting_result', 1);
        Setting::put('disable_offline_voting_result_upload', 0);
        Setting::put('enable_sms_gateway_service', 0);
        Setting::put('enable_voting_functions', \App\Models\Setting::VFN_BOTH);
        Setting::put('ballot_print', 1);
        Setting::put('print_code', 'barcode');
        Setting::put('max_limit', 100);
    } catch (\Exception $exception) {
        throw $exception;
    }

    echo "Database is cleaned.<br>";
    echo "<a href='" . url('/') . "' style='margin-top: 10px;'>Go Back</a>";
});
