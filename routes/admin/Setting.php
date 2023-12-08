<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/global-setting', [SettingController::class, 'globalSetting'])->name('global-setting');
Route::put('/update-global-setting', [SettingController::class, 'updateGlobalSetting'])->name('update-global-setting');

Route::get('/email-setting', [SettingController::class, 'emailSetting'])->name('email-setting');
Route::put('/update-email-setting', [SettingController::class, 'updateEmailSetting'])->name('update-email-setting');
Route::get('/sms-setting', [SettingController::class, 'smsSetting'])->name('sms-setting');
Route::put('/update-sms-setting', [SettingController::class, 'updateSmsSetting'])->name('update-sms-setting');
Route::post('/send-test-email', [SettingController::class, 'sendTestEmail'])->name('send-test-email');
Route::post('/send-test-sms', [SettingController::class, 'sendTestSms'])->name('send-test-sms');

Route::get('/voting-schedule', [SettingController::class, 'votingSchedule'])->name('voting-schedule');
Route::put('/update-voting-schedule', [SettingController::class, 'updateVotingSchedule'])->name('update-voting-schedule');

Route::get('/print-setting', [SettingController::class, 'printSetting'])->name('print-setting');
Route::put('/update-print-setting', [SettingController::class, 'updatePrintSetting'])->name('update-print-setting');

Route::get('/action-setting', [SettingController::class, 'actionSetting'])->name('action-setting');
Route::put('/ajax-change-setting-status', [SettingController::class, 'ajaxChangeSettingStatus'])->name('ajax-change-setting-status');
Route::put('/ajax-change-setting-value', [SettingController::class, 'ajaxChangeSettingValue'])->name('ajax-change-setting-value');

Route::post('/merge-ballot', [SettingController::class, 'mergeBallot'])->name('merge-ballot');
