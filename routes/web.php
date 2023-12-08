<?php

use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\HomeController;
use App\Jobs\SmsSendingJob;
use App\Mail\SendOtpEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test-email', function () {
    Mail::to('sadeksltn@gmail.com')->send(new SendOtpEmail('554'));

    echo 'Mail sent.';
});

Route::get('/test-sms', function () {
    SmsSendingJob::dispatch([
        'receiver' => '01676717945',
        'message' => 'Test message',
    ]);
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/archive', [ArchivesController::class, 'archiveStore']);
    Route::get('/archive-summary', [ArchivesController::class, 'index'])->name('archive-summary');

    Route::get('/common/test-devices-services', [CommonController::class, 'viewDevicesServices']);
    Route::post('/common/send-test-email', [CommonController::class, 'sendTestEmail']);
    Route::post('/common/send-test-sms', [CommonController::class, 'sendTestSms']);
    Route::get('/common/test-print-rongta', [CommonController::class, 'testPrintRongta']);

    include('admin/Voter.php');
    include('admin/Application.php');
    include('admin/Counter.php');
    include('admin/CounterOfficer.php');
    include('admin/Position.php');
    include('admin/Candidate.php');
    include('admin/Ballot.php');
    include('admin/QrCode.php');
    include('admin/EmailTemplate.php');
    include('admin/User.php');
    include('admin/Role.php');
    include('admin/Permission.php');
    include('admin/Setting.php');
    include('admin/Token.php');
    include('admin/OfflineToken.php');
    include('admin/Result.php');
    include('admin/ActivityLog.php');
    include('admin/EmailLog.php');

    include('commands.php');
});


