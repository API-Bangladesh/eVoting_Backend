<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Mail\SendApplicationApprovalEmail;
use App\Mail\SendApplicationDeclinedEmail;
use App\Models\Application;
use App\Models\Voter;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ApplicationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function index()
    {
        $this->authorize('read-submissions applications');

        try {
            $applications = Application::paginate();
            $filesOffsetData = chunk_files_with_paginate_data(Application::count());
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.application.index', compact('applications', 'filesOffsetData'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function createApplicationForm()
    {
        $this->authorize('create-form applications');

        try {
            $formFields = Setting::get('application_submission_form') ?? [];
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.application.create-application-form', compact('formFields'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function storeApplicationForm(Request $request)
    {
        $this->authorize('create-form applications');

        try {
            $data = $request->_data;
            Setting::put('application_submission_form', $data);
        } catch (\Exception $exception) {
            report($exception);

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully.',
            'data' => $data,
            'redir' => URL::previous(),
            'redirAfter' => '1000',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function downloadSubmissionListPDF(Request $request)
    {
        $this->authorize('export-submissions applications');

        try {
            $start = (int)$request->get('start');
            $end = (int)$request->get('end');
            $limit = (int)$request->get('limit');

            $fileName = 'APPLICATIONS-' . now() . '.pdf';

            if ($start || $end || $limit) {
                $applications = Application::offset($start)->limit($limit)->get();
                $fileName = "APPLICATIONS-($start-$end)-" . now() . ".pdf";
            } else {
                $applications = Application::all();
            }

            $pdf = PDF::loadView('admin.application.download-pdf', compact('applications'));
            $pdf->setPaper('A4', 'landscape');

            return $pdf->stream($fileName);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param $voter_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateApproveStatus($voter_id)
    {
        $this->authorize('approve-submissions applications');

        DB::beginTransaction();

        try {
            $applicationSubmission = Application::where('voter_id', $voter_id)->first();
            $applicationSubmission->is_approved = 1;
            $applicationSubmission->is_declined = Null;
            $applicationSubmission->declined_reason = Null;
            $applicationSubmission->update();

            // Fetch voter data
            $voter = Voter::find($voter_id);
            $voter->is_online_voter = 1;
            $voter->update();

            Mail::to($voter->email_address)->send(new SendApplicationApprovalEmail());
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('success', 'Record updated successfully.');
    }

    /**
     * @param Request $request
     * @param $voter_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateDeclinedStatus(Request $request, $voter_id)
    {
        $this->authorize('decline-submissions applications');

        DB::beginTransaction();

        try {
            $applicationSubmission = Application::where('voter_id', $voter_id)->first();
            $applicationSubmission->is_declined = 1;
            $applicationSubmission->is_approved = Null;
            $applicationSubmission->declined_reason = $request->reason;
            $applicationSubmission->update();

            $voter = Voter::where('id', $voter_id)->first();
            $voter->is_online_voter = Null;
            $voter->update();

            Mail::to($voter->email_address)->send(new SendApplicationDeclinedEmail($applicationSubmission));
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('success', 'Record updated successfully.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiStoreApplicationSubmissionForm(Request $request)
    {
        DB::beginTransaction();

        try {

            if (Setting::get('lock_online_token') == 1) {
                return static::makeErrorResponse("Token already generated & locked on approved online voters.");
            }

            $voter = Voter::where('member_id', $request->member_id)->where('contact_number', $request->phone)->first();
            if (empty($voter)) {
                return static::makeErrorResponse("Member does not exists. <br>Please check the Member ID or Phone.");
            }

            $applicationSubmission = Application::where('voter_id', $voter->id)->exists();
            if ($applicationSubmission) {
                return static::makeErrorResponse("Application already submitted.");
            }

            if (Setting::get('application_subscription_start_date') >= Carbon::now()->format('Y-m-d H:i:s') && Setting::get('application_subscription_end_date') <= Carbon::now()->format('Y-m-d 11:59:59')) {
                return static::makeErrorResponse('Online voting approval application not yet started or expired.');
            }

            Application::create([
                'voter_id' => $voter->id,
                'form_data' => $request->all()
            ]);
        } catch (Exception $exception) {
            report($exception);

            DB::rollBack();

            return static::makeErrorResponse($exception->getMessage());
        }

        DB::commit();

        return static::makeSuccessResponse('Record saved successfully..');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function batchUpdateApplicationStatus(Request $request)
    {
        $this->authorize('approve applications');

        if (!$request->has('batch_actions')) {
            return back()->with('warning', "You did't select any actions.")->withInput();
        }

        if (!$request->has('ids') || !$request->filled('ids')) {
            return back()->with('warning', "You did't select any rows.")->withInput();
        }

        DB::beginTransaction();

        try {
            if ($request->batch_actions == "approved") {
                $applications = Application::whereIn('id', $request->ids)->get();
                if (empty($applications)) {
                    return back()->with('warning', "Invalid form request.")->withInput();
                }

                foreach ($applications as $application) {
                    $application->is_approved = 1;
                    $application->is_declined = 0;
                    $application->update();

                    $voter = Voter::find($application->voter_id);
                    $voter->is_online_voter = 1;
                    $voter->update();

                    Mail::to($voter->email_address)->send(new SendApplicationApprovalEmail());
                }
            }
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Records approved successfully.');
    }
}
