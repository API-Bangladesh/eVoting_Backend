<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Http\Requests\EmailTemplateRequest;
use App\Jobs\SmsSendingJob;
use App\Mail\SendApplicationFormLinkEmail;
use App\Mail\SendGeneralEmail;
use App\Mail\SendVotingLinkEmail;
use App\Mail\SendVotingStartedEmail;
use App\Models\EmailTemplate;
use App\Models\Voter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTemplateController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read email-templates');

        try {
            $emailTemplates = EmailTemplate::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.email-template.email-template-list', compact('emailTemplates'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create email-templates');

        return view('admin.email-template.create-email-template');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(EmailTemplateRequest $request)
    {
        $this->authorize('create email-templates');

        try {
            if ($request->category_id == EmailTemplate::ONLINE_VOTING_INVITATION) {
                is_token_generated();
            }

            $created = EmailTemplate::create([
                'category_id' => $request->category_id,
                'receiver_type_id' => $request->receiver_type_id,
                'subject' => $request->subject,
                'body' => $request->body,
                'sms' => $request->sms,
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect('edit-email-template/' . $created->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function sendEmailTemplate($id)
    {
        $this->authorize('send email-templates');

        try {
            $emailTemplate = EmailTemplate::findOrFail($id);
            $categoryId = $emailTemplate->category_id;

            switch ($categoryId) {
                case EmailTemplate::ONLINE_APPLICATION_FORM:
                    $this->sendApplicationFormLinkEmail($emailTemplate);
                    return back()->with('success', 'Email sent successfully.');
                case EmailTemplate::ONLINE_VOTING_INVITATION:
                    $this->sendVotingLinkEmail($emailTemplate);
                    return back()->with('success', "Email sent successfully.");
                case EmailTemplate::ONLINE_VOTING_STARTED:
                    $this->sendVotingStartedEmail($emailTemplate);
                    return back()->with('success', "Email sent successfully.");
                case EmailTemplate::GENERAL:
                    $this->sendGeneralEmail($emailTemplate);
                    return back()->with('success', "Email sent successfully.");
                default:
                    return back()->with('error', 'An error occurred, while sending email.');
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param EmailTemplate $emailTemplate
     * @throws \Exception
     */
    private function sendApplicationFormLinkEmail(EmailTemplate $emailTemplate)
    {
        if (empty(config('app.online_application_form_url'))) {
            throw new \Exception('Online application form url is not setting up. Please check your global settings.');
        }

        Voter::all()->map(function ($voter) use ($emailTemplate) {
            Mail::to($voter->email_address)->send(new SendApplicationFormLinkEmail($emailTemplate, $voter));

            if (Setting::get('enable_sms_gateway_service')) {
                SmsSendingJob::dispatch([
                    'receiver' => $voter->contact_number,
                    'message' => $emailTemplate->sms,
                ]);
            }
        });

        // Update sending counter
        $sentLogs = is_json($emailTemplate->sent_logs) ? json_decode($emailTemplate->sent_logs, true) : [];
        $sentLogs[] = Carbon::now()->format('Y-m-d H:i:s');

        $emailTemplate->counter = $emailTemplate->counter += 1;
        $emailTemplate->sent_logs = json_encode($sentLogs);
        $emailTemplate->update();
    }

    /**
     * @param EmailTemplate $emailTemplate
     */
    public function sendVotingStartedEmail(EmailTemplate $emailTemplate)
    {
        Voter::where('is_online_voter', 1)->get()->map(function ($voter) use ($emailTemplate) {
            Mail::to($voter->email_address)->send(new SendVotingStartedEmail($emailTemplate));

            if (Setting::get('enable_sms_gateway_service')) {
                SmsSendingJob::dispatch([
                    'receiver' => $voter->contact_number,
                    'message' => $emailTemplate->sms,
                ]);
            }
        });

        // Update sending counter
        $sentLogs = is_json($emailTemplate->sent_logs) ? json_decode($emailTemplate->sent_logs, true) : [];
        $sentLogs[] = Carbon::now()->format('Y-m-d H:i:s');

        $emailTemplate->counter = $emailTemplate->counter += 1;
        $emailTemplate->sent_logs = json_encode($sentLogs);
        $emailTemplate->update();
    }

    /**
     * @param EmailTemplate $emailTemplate
     * @throws \Exception
     */
    private function sendVotingLinkEmail(EmailTemplate $emailTemplate)
    {
        if (empty(config('app.online_voting_url'))) {
            throw new \Exception('Online voting url is not setting up. Please check your global settings.');
        }

        if (Setting::get('lock_online_token') != 1) {
            throw new \Exception('Token generation is not locked yet!');
        }

        $onlineVoters = Voter::where('is_online_voter', 1)->get();

        foreach ($onlineVoters as $onlineVoter) {
            $token = optional($onlineVoter->token)->token;
            if (empty($token)) continue;

            Mail::to($onlineVoter->email_address)->send(new SendVotingLinkEmail($emailTemplate, $token));

            if (Setting::get('enable_sms_gateway_service')) {
                SmsSendingJob::dispatch([
                    'receiver' => $onlineVoter->contact_number,
                    'message' => $emailTemplate->sms,
                ]);
            }
        }

        // Update sending counter
        $sentLogs = is_json($emailTemplate->sent_logs) ? json_decode($emailTemplate->sent_logs, true) : [];
        $sentLogs[] = Carbon::now()->format('Y-m-d H:i:s');

        $emailTemplate->counter = $emailTemplate->counter += 1;
        $emailTemplate->sent_logs = json_encode($sentLogs);
        $emailTemplate->update();
    }

    /**
     * @param EmailTemplate $emailTemplate
     * @throws \Exception
     */
    private function sendGeneralEmail(EmailTemplate $emailTemplate)
    {
        $voters = [];

        if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_VOTERS) {
            $voters = Voter::all();
        } else if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS) {
            $voters = Voter::where('is_online_voter', 1)->get();
        } else if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS) {
            $voters = Voter::where('is_online_voter', NULL)->get();
        }

        $voters->map(function ($voter) use ($emailTemplate) {
            Mail::to($voter->email_address)->send(new SendGeneralEmail($emailTemplate));

            if (Setting::get('enable_sms_gateway_service')) {
                SmsSendingJob::dispatch([
                    'receiver' => $voter->contact_number,
                    'message' => $emailTemplate->sms,
                ]);
            }
        });

        // Update sending counter
        $sentLogs = is_json($emailTemplate->sent_logs) ? json_decode($emailTemplate->sent_logs, true) : [];
        $sentLogs[] = Carbon::now()->format('Y-m-d H:i:s');

        $emailTemplate->counter = $emailTemplate->counter += 1;
        $emailTemplate->sent_logs = json_encode($sentLogs);
        $emailTemplate->update();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update email-templates');

        try {
            $emailTemplate = EmailTemplate::find($id);

            // Count all receivers by receiver type
            if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_VOTERS) {
                $countReceivers = Voter::count();
            } else if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS) {
                $countReceivers = Voter::whereNotNull('is_online_voter')->count();
            } else if ($emailTemplate->receiver_type_id == EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS) {
                $countReceivers = Voter::whereNull('is_online_voter')->count();
            } else {
                $countReceivers = 0;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.email-template.edit-email-template', compact('emailTemplate', 'countReceivers'));
    }

    /**
     * @param EmailTemplateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(EmailTemplateRequest $request, $id)
    {
        $this->authorize('update email-templates');

        try {
            $emailTemplate = EmailTemplate::find($id);
            $emailTemplate->subject = $request->subject;
            $emailTemplate->receiver_type_id = $request->receiver_type_id;
            $emailTemplate->body = $request->body;
            $emailTemplate->sms = $request->sms;

            /*$emailTemplate->schedule_date = $request->schedule_date ? Carbon::parse($request->schedule_date)->format('Y-m-d') : Null;
            $emailTemplate->schedule_time = $request->schedule_time ? Carbon::parse($request->schedule_time)->format('H:i:s') : Null;*/
            $emailTemplate->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete email-templates');

        try {
            $emailTemplate = EmailTemplate::find($id);
            $emailTemplate->delete();
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewEmailSendingStatus()
    {
        return view('admin.email-template.email-sending-status');
    }
}
