<?php

namespace App\Http\Controllers;

use App\Exports\VoterExport;
use App\Facades\Setting;
use App\Http\Requests\VoterRequest;
use App\Models\EmailTemplate;
use App\Models\Voter;
use App\Services\VoterImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use ZipArchive;

/**
 * @method forceDelete()
 */
class VoterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read voters');

        try {
            $voters = Voter::paginate();
            $filesOffsetData = chunk_files_with_paginate_data(Voter::count());
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.index', compact('voters', 'filesOffsetData'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('create voters');

        if (is_enable_offline_voting_function() && Setting::get('lock_qr_code')) {
            abort(500, "Qr Code generation is locked.");
        }
        if (is_enable_online_voting_function() && Setting::get('lock_online_token')) {
            abort(500, "Token generation is locked.");
        }

        return view('admin.voter.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VoterRequest $request)
    {
        $this->authorize('create voters');

        if (is_enable_offline_voting_function() && Setting::get('lock_qr_code')) {
            abort(500, "Qr Code generation is locked.");
        }
        if (is_enable_online_voting_function() && Setting::get('lock_online_token')) {
            abort(500, "Token generation is locked.");
        }

        try {
            Voter::create([
                'name' => $request->name,
                'member_id' => $request->member_id,
                'category' => $request->category,
                'email_address' => $request->email_address,
                'contact_number' => $request->contact_number,
                'image' => do_upload_file($request, 'image', 'old_image')
            ]);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return back()->with('success', 'Record saved successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyVoter($id)
    {
        $this->authorize('delete voters');

        try {
            $voter = Voter::find($id);
            $voter->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update voters');

        try {
            $voter = Voter::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.edit', compact('voter'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(VoterRequest $request, $id)
    {
        $this->authorize('update voters');

        try {
            $voter = Voter::find($id);

            $voter->name = $request->name;
            $voter->member_id = $request->member_id;
            $voter->category = $request->category;
            $voter->email_address = $request->email_address;
            $voter->contact_number = $request->contact_number;
            $voter->image = do_upload_file($request, 'image', 'old_image');

            $voter->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function importVoters()
    {
        $this->authorize('import voters');

        return view('admin.voter.import-voters');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function storeImportedVoters(Request $request)
    {
        $this->authorize('create voters');

        if (!$request->hasFile('excelfile') && !$request->hasFile('zipfile')) {
            return back()->with('warning', 'Please browse required files.');
        }

        DB::beginTransaction();

        try {
            // Import process
            if ($request->hasFile('excelfile')) {
                if (Voter::count() > 0) {
                    return back()->with('warning', 'Voter already imported.');
                }

                Excel::import(new VoterImportService, $request->file('excelfile')->store('temp'));
            }

            // Extract process
            if ($request->hasFile('zipfile')) {
                $zipFile = $request->file('zipfile');
                $zipUploadDir = public_path("uploads/zipfile");
                $fileUploadDir = get_upload_directory_path();

                $zipFilename = basename($zipFile->getClientOriginalName());
                $zipFile->move($zipUploadDir, $zipFilename);

                $zip = new ZipArchive();
                if ($zip->open("{$zipUploadDir}/{$zipFilename}") == True) {
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $imgFilename = $zip->getNameIndex($i);
                        $imgFileInfo = pathinfo($imgFilename);

                        // Copy image file to upload directory
                        copy("zip://{$zipUploadDir}/{$zipFilename}" . "#" . $imgFileInfo['basename'], "{$fileUploadDir}/{$imgFileInfo['basename']}");

                        // member_id & filename is same e.g. 455661
                        $memberId = $imgFileInfo['filename'];

                        if (!empty($memberId)) {
                            try {
                                $voter = Voter::where('member_id', $memberId)->first();
                                $voter->image = "{$fileUploadDir}/{$imgFileInfo['basename']}";
                                $voter->update();
                            } catch (\Exception $exception) {
                                report($exception);
                                continue;
                            }
                        }
                    }

                    $zip->close();
                }
            }
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('success', "Record imported successfully.");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $this->authorize('search voters');

        try {
            $keyword = trim($request->keyword);

            $query = Voter::query();

            if ($request->filled('keyword')) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('member_id', 'LIKE', "%{$keyword}%")
                        ->orWhere('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('category', 'LIKE', "%{$keyword}%")
                        ->orWhere('email_address', 'LIKE', "%{$keyword}%")
                        ->orWhere('contact_number', 'LIKE', "%{$keyword}%");
                });
            }

            if ($request->filled('missing')) {
                $query->orWhere(function ($query) {
                    $query->orWhereNull('name')
                        ->orWhereNull('category')
                        ->orWhereNull('email_address')
                        ->orWhereNull('contact_number');
                });
            }

            $query->orderBy('created_at', 'desc');
            $voters = $query->paginate();

            $voters->appends($request->all());

            // Segregate files
            $filesOffsetData = chunk_files_with_paginate_data(Voter::count());
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.index', compact('voters', 'filesOffsetData'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function downloadVotersPDF(Request $request)
    {
        $this->authorize('export voters');

        try {
            $start = (int)$request->get('start');
            $end = (int)$request->get('end');
            $limit = (int)$request->get('limit');

            $fileName = 'VOTERS-' . now() . '.pdf';

            if ($start || $end || $limit) {
                $voters = Voter::offset($start)->limit($limit)->get();
                $fileName = "VOTERS-($start-$end)-" . now() . ".pdf";
            } else {
                $voters = Voter::all();
            }

            $pdf = PDF::loadView('admin.voter.download-voters-pdf', compact('voters'));
            $pdf->setPaper('A4', 'landscape');

            return $pdf->stream($fileName);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function viewDeletedVoterList()
    {
        $this->authorize('read voters');

        try {
            $voters = Voter::onlyTrashed()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.deleted-voter-list', compact('voters'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function viewOnlineVoterList()
    {
        $this->authorize('read-online-voters voters');

        try {
            $onlineVoters = Voter::where('is_online_voter', 1)->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.online-voter-list', compact('onlineVoters'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function viewOfflineVoterList()
    {
        $this->authorize('read-offline-voters voters');

        try {
            $offlineVoters = Voter::where('is_online_voter', NULL)->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.voter.offline-voter-list', compact('offlineVoters'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trash($id)
    {
        $this->authorize('trash voters');

        try {
            if (Setting::get('disable_voters_deletion')) {
                throw new \Exception("Deletion function is disabled.");
            }

            $voter = Voter::find($id);
            $voter->delete();
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record trashed successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $this->authorize('restore voters');

        if (Setting::get('disable_voters_import')) {
            abort(500, "Disable voter import.");
        }
        if (is_enable_offline_voting_function() && Setting::get('lock_qr_code')) {
            abort(500, "Qr Code generation is locked.");
        }
        if (is_enable_online_voting_function() && Setting::get('lock_online_token')) {
            abort(500, "Token generation is locked.");
        }

        try {
            $voter = Voter::withTrashed()->where('id', $id)->first();
            $voter->restore();
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record restored successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete voters');

        try {
            if (Setting::get('disable_permanently_voters_deletion')) {
                throw new \Exception("Permanently delete function is disabled.");
            }

            $voter = Voter::withTrashed()->find($id);
            remove_file($voter->image);
            $voter->forceDelete();
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function permanentlyDeleteVoters()
    {
        $this->authorize('delete-permanently voters');

        if (Setting::get('disable_permanently_voters_deletion')) {
            abort(500, "Permanently delete function is disabled.");
        }

        ini_set('max_execution_time', 300);

        try {
            $voters = Voter::withTrashed()->get();
            $voters->map(function ($voter) {
                $this->destroy($voter->id);
            });

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('applications')->truncate();
            DB::table('qr_codes')->truncate();
            DB::table('tokens')->truncate();
            DB::table('offline_tokens')->truncate();
            DB::table('voters')->truncate();
            DB::table('votes')->truncate();
            DB::table('candidates')->update([
                'counter' => Null,
                'offline_vote_count' => Null
            ]);
            DB::table('email_templates')->update([
                'counter' => Null,
            ]);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $setting = Setting::instance();
            $setting->lock_online_token = Null;
            $setting->lock_qr_code = Null;
            $setting->update();
        } catch (\Exception $exception) {
            report($exception);

            abort(500, $exception->getMessage());
        }

        return back()->with('success', 'Records deleted successfully.');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function printVotersPDF(Request $request)
    {
        $this->authorize('export voters');

        try {
            $start = (int)$request->get('start');
            $end = (int)$request->get('end');
            $limit = (int)$request->get('limit');

            $fileName = 'PRINTABLE-VOTERS-' . now() . '.pdf';

            if ($start || $end || $limit) {
                $voters = Voter::offset($start)->limit($limit)->get();
                $fileName = "PRINTABLE-VOTERS-($start-$end)-" . now() . '.pdf';
            } else {
                $voters = Voter::all();
            }

            $pdf = PDF::loadView('admin.voter.print-voters-pdf', compact('voters'));
            $pdf->setPaper('A4', 'landscape');
            $pdf->setWarnings(false);

            return $pdf->stream($fileName);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function VotersExportExcel()
    {
        $this->authorize('export voters');

        return Excel::download(new VoterExport, 'Voter List.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countVotersAsReceiver(Request $request)
    {
        try {
            $receiver_type_id = $request->receiver_type_id;
            $count = 0;

            if ($receiver_type_id == EmailTemplate::RECEIVER_ALL_VOTERS) {
                $count = Voter::count();
            } elseif ($receiver_type_id == EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS) {
                $count = Voter::where('is_online_voter', 1)->count();
            } elseif ($receiver_type_id == EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS) {
                $count = Voter::whereNull('is_online_voter')->count();
            }
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse("Record fetched successfully.", ['count' => $count]);
    }
}
