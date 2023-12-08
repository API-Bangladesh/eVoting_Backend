<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Models\Ballot;
use App\Models\QrCode;
use App\Models\Voter;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read qr-codes');

        try {
            $qrCodes = QrCode::paginate();
            $filesOffsetData = chunk_files_with_paginate_data(QrCode::count());
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.qr-code.index', compact('qrCodes', 'filesOffsetData'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function lockQrCode()
    {
        $this->authorize('lock qr-codes');

        try {
            Setting::put('lock_qr_code', 1);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Qr Code Locked Successfully.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateQrCodes(Request $request)
    {
        $this->authorize('generate qr-codes');

        if (Setting::get('lock_qr_code')) {
            abort(500, "Qr Code generation is locked.");
        }

        DB::beginTransaction();

        try {
            $query = Voter::query();
            $query->where('is_online_voter', '!=', 1);
            $query->orWhereNull('is_online_voter');
            $offlineVoters = $query->get();

            DB::table('qr_codes')->delete();

            $offlineVoters->map(function () {
                QrCode::create([
                    'code' => Str::upper(Str::random(6))
                ]);
            });
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('success', 'Code generated successfully.');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function downloadQrCodesPDF(Request $request)
    {
        $this->authorize('export qr-codes');

        try {
            $start = (int)$request->get('start');
            $end = (int)$request->get('end');
            $limit = (int)$request->get('limit');

            $fileName = 'QRCODES-' . now() . '.pdf';
            $fileNameWithBallot = 'QRCODES-WITH-BALLOT-' . now() . '.pdf';

            if ($start || $end || $limit) {
                $qrCodes = QrCode::offset($start)->limit($limit)->get();

                $fileName = "QRCODES-($start-$end)-" . now() . ".pdf";
                $fileNameWithBallot = "QRCODES-WITH-BALLOT-($start-$end)-" . now() . ".pdf";
            } else {
                $qrCodes = QrCode::all();
            }

            if (Setting::get('ballot_print')) {
                $ballots = Ballot::with('position', 'ballotItems')->get();

                $pdf = PDF::loadView('admin.qr-code.download-qr-codes-with-ballot-pdf', compact('qrCodes', 'ballots'));
                set_paper_size($pdf);
                return $pdf->stream($fileNameWithBallot);
            } else {
                $pdf = PDF::loadView('admin.qr-code.download-qr-codes-pdf', compact('qrCodes'));
                set_paper_size($pdf);
                return $pdf->stream($fileName);
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function validateQrCodeList()
    {
        $this->authorize('validate-ballots qr-codes');

        try {
            $qrCodes = QrCode::with('validatedBy')->latest('updated_at')->paginate();
            $counts = [
                'validated' => QrCode::whereNotNull('scan_blank_ballot')->count(),
                'notValidated' => QrCode::whereNull('scan_blank_ballot')->count(),
            ];
        } catch (\Exception $exception) {
            throw $exception;
        }
        return view('admin.qr-code.validate-qr-code-list', compact('qrCodes', 'counts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function validateQrCode(Request $request)
    {
        $this->authorize('validate-ballots qr-codes');

        try {
            $qrCode = QrCode::where('code', $request->scan_input)->first();

            if (empty($qrCode)) {
                return back()->with('error', 'Ballot suspect.');
            }

            // Validated
            if ($qrCode->scan_blank_ballot != Null && $qrCode->scan_voted_ballot == Null) {
                return back()->with('warning', 'This ballot already validated.');
            }

            // Not Validated
            if ($qrCode->scan_blank_ballot == Null && $qrCode->scan_voted_ballot != Null) {
                return back()->with('warning', 'This ballot is not validated yet.');
            }

            // Used
            if ($qrCode->scan_blank_ballot != Null && $qrCode->scan_voted_ballot != Null) {
                return back()->with('warning', 'Ballot already validated.');
            }

            // Matched & Update
            if ($qrCode->scan_blank_ballot == Null && $qrCode->scan_voted_ballot == Null) {
                $qrCode->scan_blank_ballot = Carbon::now();
                $qrCode->validated_by = Auth::id();
                $qrCode->update();

                return back()->with('info', 'Ballot matched.');
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function verifyQrCodeList()
    {
        $this->authorize('verify-ballots qr-codes');

        try {
            $qrCodes = QrCode::with('verifiedBy')->latest('updated_at')->paginate();
            $counts = [
                'verified' => QrCode::whereNotNull('scan_voted_ballot')->count(),
                'notVerified' => QrCode::whereNull('scan_voted_ballot')->count(),
            ];
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.qr-code.verify-qr-code-list', compact('qrCodes', 'counts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function verifyQrCode(Request $request)
    {
        $this->authorize('verify-ballots qr-codes');

        try {
            $qrCode = QrCode::where('code', $request->scan_input)->first();

            if (empty($qrCode)) {
                return back()->with('error', 'Ballot suspect.');
            }

            // Not Validated
            if ($qrCode->scan_blank_ballot == Null && $qrCode->scan_voted_ballot == Null) {
                return back()->with('info', 'This ballot is not validated yet.');
            }

            // Not Validated
            if ($qrCode->scan_blank_ballot == Null && $qrCode->scan_voted_ballot != Null) {
                return back()->with('warning', 'This ballot is not validated yet.');
            }

            // Already Verified
            if ($qrCode->scan_blank_ballot != Null && $qrCode->scan_voted_ballot != Null) {
                return back()->with('warning', 'Ballot already verified.');
            }

            if ($qrCode->scan_blank_ballot != Null && $qrCode->scan_voted_ballot == Null) {
                $qrCode->is_used = 1;
                $qrCode->scan_voted_ballot = Carbon::now();
                $qrCode->verified_by = Auth::id();
                $qrCode->update();

                return back()->with('success', 'Ballot matched.');
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
