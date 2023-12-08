<?php

namespace App\Http\Controllers;


use App\Facades\Setting;
use App\Http\Requests\EmailSettingRequest;
use App\Http\Requests\GlobalSettingRequest;
use App\Http\Requests\PrintSettingRequest;
use App\Http\Requests\SmsSettingRequest;
use App\Http\Requests\VotingScheduleSettingRequest;
use App\Jobs\SmsSendingJob;
use App\Mail\SendTestEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function votingSchedule()
    {
        $this->authorize('update-voting-schedule settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.voting-schedule', compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateVotingSchedule(VotingScheduleSettingRequest $request)
    {
        $this->authorize('update-voting-schedule settings');

        try {
            $setting = Setting::instance();
            $setting->election_year = $request->election_year;
            $setting->voting_schedule_start_date = $request->voting_schedule_start_date ? Carbon::parse($request->voting_schedule_start_date)->format('Y-m-d') : Null;
            $setting->voting_schedule_start_time = $request->voting_schedule_start_time ? Carbon::parse($request->voting_schedule_start_time)->format('H:i:s') : Null;
            $setting->voting_schedule_end_time = $request->voting_schedule_end_time ? Carbon::parse($request->voting_schedule_end_time)->format('H:i:s') : Null;
            $setting->application_subscription_start_date = $request->application_subscription_start_date ? Carbon::parse($request->application_subscription_start_date)->format("Y-m-d") : Null;
            $setting->application_subscription_end_date = $request->application_subscription_end_date ? Carbon::parse($request->application_subscription_end_date)->format('Y-m-d') : Null;
            $setting->officer_secret_code = $request->officer_secret_code ? $request->officer_secret_code : Null;
            $setting->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function globalSetting()
    {
        $this->authorize('update settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.global-setting', compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGlobalSetting(GlobalSettingRequest $request)
    {
        $this->authorize('update settings');

        DB::beginTransaction();

        try {
            $setting = Setting::instance();
            $setting->organization_name = $request->organization_name;
            $setting->icon = do_upload_file($request, 'icon', 'old_icon');
            $setting->logo_type = $request->logo_type;
            $setting->online_application_form_url = $request->online_application_form_url;
            $setting->online_voting_url = $request->online_voting_url;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function emailSetting()
    {
        $this->authorize('update-email-config settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.email-setting', compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmailSetting(EmailSettingRequest $request)
    {
        $this->authorize('update-email-config settings');

        DB::beginTransaction();

        try {
            $setting = Setting::instance();

            $setting->mail_mailer = $request->mail_mailer;
            $setting->mail_host = $request->mail_host;
            $setting->mail_port = $request->mail_port;
            $setting->mail_username = $request->mail_username;
            $setting->mail_password = $request->mail_password;
            $setting->mail_from_address = $request->mail_from_address;
            $setting->mail_from_name = $request->mail_from_name;
            $setting->mail_encryption = $request->mail_encryption;

            $setting->aws_access_key = $request->aws_access_key;
            $setting->aws_secret_key = $request->aws_secret_key;
            $setting->aws_region = $request->aws_region;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function smsSetting()
    {
        $this->authorize('update-sms-config settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.sms-setting', compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSmsSetting(SmsSettingRequest $request)
    {
        $this->authorize('update-sms-config settings');

        DB::beginTransaction();

        try {
            $setting = Setting::instance();

            $setting->api_token_sslwireless = $request->api_token_sslwireless;
            $setting->domain_sslwireless = $request->domain_sslwireless;
            $setting->sid_sslwireless = $request->sid_sslwireless;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function printSetting()
    {
        $this->authorize('update-print-config settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.print-setting', compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePrintSetting(PrintSettingRequest $request)
    {
        $this->authorize('update-print-config settings');

        DB::beginTransaction();

        try {
            $setting = Setting::instance();
            $setting->ballot_print = $request->ballot_print;
            $setting->print_code = $request->print_code;
            $setting->position = $request->position;
            $setting->orientation = $request->orientation;
            $setting->paper_size = $request->paper_size;
            $setting->width = ($setting->paper_size == 'custom') ? $request->width : Null;
            $setting->height = ($setting->paper_size == 'custom') ? $request->height : Null;
            $setting->max_limit = $request->max_limit;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function actionSetting()
    {
        $this->authorize('update-actions settings');

        try {
            $setting = Setting::instance();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.setting.action-setting', compact('setting'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetApplicationSubmissionForm()
    {
        try {
            $setting = Setting::instance();
            $applicationSubmissionForm = $setting->application_submission_form;
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully.', $applicationSubmissionForm);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mergeBallot(Request $request)
    {
        $this->authorize('update settings');

        try {
            $setting = Setting::instance();
            $setting->ballot_merge_all = !$setting->ballot_merge_all;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully.', $request->data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetCompanyDetails()
    {
        try {
            $setting = Setting::instance();

            return static::makeSuccessResponse('Record fetched successfully.', [
                'organization' => $setting->organization_name,
                'address' => $setting->address,
                'icon' => get_uploaded_file_url($setting->icon)
            ]);
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetApplicationSubmissionSchedule()
    {
        try {
            $setting = Setting::instance();

            return static::makeSuccessResponse('Record fetched successfully.', [
                'application_submission_start_date' => $setting->application_subscription_start_date,
                'application_submission_end_date' => $setting->application_subscription_end_date
            ]);
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxChangeSettingStatus(Request $request)
    {
        $this->authorize('update settings');

        $fieldName = $request->fieldName;

        if (empty($fieldName)) {
            static::makeErrorResponse("Request is not valid.", [], 500);
        }

        try {
            $setting = Setting::instance();
            $setting->$fieldName = !$setting->$fieldName;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse('An error occurred, while trying to update setting.', [], 500);
        }

        return static::makeSuccessResponse('Setting updated successfully.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxChangeSettingValue(Request $request)
    {
        $this->authorize('update settings');

        $inputs = $request->all();

        try {
            $setting = Setting::instance();
            $setting->fill($inputs);
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse('An error occurred, while trying to update setting.', [], 500);
        }

        return static::makeSuccessResponse('Setting updated successfully.');
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
                'subject' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('email-setting')->withInput()->withErrors($validator);
            }

            Mail::to($request->email)->send(new SendTestEmail($request));

        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect('email-setting')->with('success', 'Email successfully sent.');
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
                'phone' => 'required',
                'sms' => 'required|max:160'
            ]);

            if ($validator->fails()) {
                return redirect('sms-setting')->withInput()->withErrors($validator);
            }

            if (Setting::get('enable_sms_gateway_service') == 0) {
                return back()->with('warning', 'SMS Service is disabled.');
            }

            // Dispatch
            SmsSendingJob::dispatch([
                'receiver' => $request->phone,
                'message' => $request->sms,
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect('sms-setting')->with('success', 'Sms successfully sent.');
    }
}
