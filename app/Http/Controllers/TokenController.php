<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Jobs\SmsSendingJob;
use App\Mail\SendOtpEmail;
use App\Models\Token;
use App\Models\Voter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize('read tokens');

        try {
            $tokens = Token::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.token.index', compact('tokens'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generateTokenList()
    {
        $this->authorize('read tokens');

        try {
            $tokens = Token::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.token.index', compact('tokens'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateTokens()
    {
        $this->authorize('generate tokens');

        if (Setting::get('lock_online_token')) {
            return back()->with('warning', 'Token generation is locked.');
        }

        try {
            $voters = Voter::where('is_online_voter', 1)->get();

            foreach ($voters as $voter) {
                $hasToken = Token::where('voter_id', $voter->id)->exists();
                if ($hasToken) continue;

                Token::create([
                    'voter_id' => $voter->id,
                    'token' => Str::upper(Str::random(6)),
                    'is_used' => Null,
                    'is_sent_email' => Null
                ]);
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Token generated successfully.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lockOnlineTokenGeneration()
    {
        $this->authorize('lock tokens');

        try {
            Setting::put('lock_online_token', 1);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Locked Token Generation.');
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiTokenValidation($token)
    {
        try {
            $token = Token::where('token', $token)->first();

            if (empty($token)) {
                return static::makeErrorResponse("Token doesn't exists.", [
                    'isTokenExist' => False
                ]);
            }

            if ($token->is_used) {
                return static::makeSuccessResponse('Vote already casted by this token.', [
                    'isTokenExist' => True,
                    'isTokenUsed' => True,
                    'used_time' => $token->updated_at
                ]);
            }

            $setting = Setting::instance();

            $votingScheduleData = array(
                'startDate' => $setting->voting_schedule_start_date,
                'startTime' => $setting->voting_schedule_start_time,
                'endTime' => $setting->voting_schedule_end_time,
                'updated_time' => $token->updated_at,
            );

            return static::makeSuccessResponse('Token is exists & not used.', [
                'isTokenExist' => True,
                'isTokenUsed' => False,
                'votingSchedule' => $votingScheduleData
            ]);
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiSendOtpEmail($token)
    {
        try {
            if (empty($token)) {
                throw new Exception("Request is not valid.");
            }

            DB::beginTransaction();

            $token = Token::where('token', $token)->first();

            if (!$token) {
                throw new Exception('Token is not exist.');
            }

            $voter = Voter::find($token->voter_id);

            // Update & send OTP
            $token->otp = rand(100000, 999999);
            $token->is_sent_email = 1;
            $token->update();

            Mail::to($voter->email_address)->send(new SendOtpEmail($token->otp));

            if (Setting::get('enable_sms_gateway_service')) {
                $message = "Your OTP code is: " . $token->otp . " for eVoting. Thank you.}";

                SmsSendingJob::dispatch([
                    'receiver' => $voter->contact_number,
                    'message' => $message,
                ]);
            }

            // Update checked_in
            $voter->is_checked_in = 1;
            $voter->update();
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            return static::makeErrorResponse($exception->getMessage());
        }

        DB::commit();

        return static::makeSuccessResponse('6 Digit OTP code has been sent to your email.');
    }

    /**
     * @param $token
     * @param $otp
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiValidateTokenAndOtpCode($token, $otp)
    {
        try {
            if (empty($token) || empty($otp)) {
                throw new Exception("Request is not valid.");
            }

            $token = Token::where('token', $token)->first();

            if ($token->otp != $otp) {
                throw new Exception("OTP does't match!!");
            }
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('OTP verified successfully.');
    }
}
