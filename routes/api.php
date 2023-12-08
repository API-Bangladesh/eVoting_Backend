<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BallotController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/application-submissions-form', [SettingController::class, 'apiGetApplicationSubmissionForm']);
Route::post('/application-submissions-form-store', [ApplicationController::class, 'apiStoreApplicationSubmissionForm']);

Route::get('/get-all-ballots', [BallotController::class, 'apiGetAllBallots']);

Route::get('/get-vote/{id}', [VoteController::class, 'apiGetSingleVote']);
Route::get('/get-total-request', [VoteController::class, 'getAllVoteIds']);

Route::post('/post-vote', [CandidateController::class, 'apiCastVote']);

Route::get('/otp/{token}', [TokenController::class, 'apiSendOtpEmail']);
Route::get('/token-validation/{token}/{otp}', [TokenController::class, 'apiValidateTokenAndOtpCode']);

Route::get('/post-token/{token}', [TokenController::class, 'apiTokenValidation']);

Route::get('/company-details', [SettingController::class, 'apiGetCompanyDetails']);
Route::get('/get-application-submission-details', [SettingController::class, 'apiGetApplicationSubmissionSchedule']);
