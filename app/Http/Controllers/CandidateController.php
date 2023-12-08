<?php

namespace App\Http\Controllers;

use App\Exports\CandidateExport;
use App\Http\Requests\CandidateRequest;
use App\Mail\SendVoteCastConfirmationEmail;
use App\Models\Candidate;
use App\Models\Token;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CandidateController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read candidates');

        try {
            $candidates = Candidate::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.candidate.index', compact('candidates'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create candidates');

        return view('admin.candidate.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CandidateRequest $request)
    {
        $this->authorize('create candidates');

        try {
            Candidate::create([
                'name' => $request->name,
                'icon' => do_upload_file($request, 'icon', 'old_icon')
            ]);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return back()->with('success', 'Record saved successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update candidates');

        try {
            $candidate = Candidate::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.candidate.edit', compact('candidate'));
    }

    /**
     * @param CandidateRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function update(CandidateRequest $request, $id)
    {
        $this->authorize('update candidates');

        try {
            $candidate = Candidate::find($id);

            $candidate->name = $request->name;
            $candidate->icon = do_upload_file($request, 'icon', 'old_icon');
            $candidate->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete candidates');

        try {
            $candidate = Candidate::find($id);
            remove_file($candidate->icon);
            $candidate->forceDelete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJsonCandidates()
    {
        try {
            $candidates = Candidate::all();
            $candidates->map(function ($candidate) {
                $candidate->icon = get_uploaded_file_url($candidate->icon);
            });
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully.', $candidates);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function exportCandidateListExcel()
    {
        $this->authorize('export candidates');

        return Excel::download(new CandidateExport, 'Candidate List.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiCastVote(Request $request)
    {
        DB::beginTransaction();

        try {
            $votedCandidateIds = array();

            foreach ($request->candidates as $key => $value) {
                $candidate = Candidate::where('id', $value['candidateId'])->first();

                if ($value['isVoted']) {
                    $candidate->counter = $candidate->counter + 1;
                    $candidate->update();
                }

                array_push($votedCandidateIds, $value['candidateId']);
            }

            // Saved
            $vote = new Vote();
            $vote->candidate_ids = $votedCandidateIds;
            $vote->save();

            $token = Token::with('voter')->where('token', $request->voterToken)->first();

            // Updated
            if ($token) {
                $token->is_used = 1;
                $token->update();
            }

            // Sending confirmation email
            Mail::to(optional($token->voter)->email_address)->send(new SendVoteCastConfirmationEmail());

        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            return static::makeErrorResponse($exception->getMessage());
        }

        DB::commit();

        return static::makeSuccessResponse('Vote casted successfully.', [
            'voterToken' => 'used'
        ]);
    }
}
