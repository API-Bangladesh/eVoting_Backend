<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Jobs\SmsSendingJob;
use App\Mail\SendTestEmail;
use App\Models\OfflineToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;

class CommonController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewDevicesServices()
    {
        return view('admin.common.test-devices-services');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function sendTestEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            if (empty(Setting::get('mail_mailer')) ||
                empty(Setting::get('mail_host')) ||
                empty(Setting::get('mail_port')) ||
                empty(Setting::get('mail_encryption')) ||
                empty(Setting::get('mail_username')) ||
                empty(Setting::get('mail_password')) ||
                empty(Setting::get('mail_from_address')) ||
                empty(Setting::get('mail_from_name'))) {
                return back()->with('warning', 'Email Setting is incomplete. Check "Email Settings"')->withInput();
            }

            $request->subject = 'eVoting Email Service';
            $request->message = 'Welcome to the eVoting management system. This is a test email for checking email service. Thanks for connecting with us.';

            Mail::to($request->email)->send(new SendTestEmail($request));

        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Email successfully sent.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function sendTestSms(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            if (Setting::get('enable_sms_gateway_service') == 0) {
                return back()->with('warning', 'SMS Service is disabled. Check "Action Settings"')->withInput();
            }

            if (empty(Setting::get('api_token_sslwireless')) ||
                empty(Setting::get('domain_sslwireless')) ||
                empty(Setting::get('sid_sslwireless'))) {
                return back()->with('warning', 'SMS Setting is incomplete. Check "SMS Settings"')->withInput();
            }

            $request->sms = 'Welcome to the eVoting management system. Thank you for connecting with us.';

            // Dispatch
            SmsSendingJob::dispatch([
                'receiver' => $request->phone,
                'message' => $request->sms,
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Sms successfully sent.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function testPrintRongta()
    {
        try {
            $offlineToken = new OfflineToken();
            $offlineToken->member_id = Str::upper(Str::random(8));
            $offlineToken->voter_id = Str::upper(Str::random(8));
            $offlineToken->voter_name = 'John Doe';
            $offlineToken->image = '';
            $offlineToken->card_no = 'N/A';
            $offlineToken->counter_number = 'AC043';
            $offlineToken->counter_name = 'East Corner';
            $offlineToken->token = Str::upper(Str::random(8));
            $offlineToken->created_at = now();

            $pdf = PDF::loadView('admin.common._test-download-token-pdf', compact('offlineToken'));
            $pdf->setPaper([0, 0, 3.0 * 72, 11.7 * 72]);
            return $pdf->download('OFFLINE-TOKEN-' . $offlineToken->member_id . '-' . now() . '.pdf');
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
