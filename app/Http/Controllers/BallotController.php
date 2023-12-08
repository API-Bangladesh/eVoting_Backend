<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\BallotItem;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class BallotController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read ballots');

        try {
            $ballots = Ballot::with('ballotItems')->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.ballot.index', compact('ballots'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function create()
    {
        $this->authorize('create ballots');

        try {
            $positions = Position::all();
            $candidates = Candidate::all();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.ballot.create', compact('positions', 'candidates'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create ballots');

        try {
            $rules = [];
            $rules['position_id'] = 'required|unique:ballots';
            $rules['vote_limit'] = 'required';

            foreach ($request->candidates as $key => $val) {
                $rules['candidates.' . $key . '.id'] = 'required';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return static::makeErrorResponse($validator->errors()->first(), $validator->errors());
            }

            $candidateIds = collect($request->candidates);
            $candidateIds = $candidateIds->flatten();

            foreach ($candidateIds as $candidateId) {
                $ballotItem = BallotItem::with('candidate')
                    ->where('candidate_id', $candidateId)
                    ->first();

                if ($ballotItem) {
                    return static::makeErrorResponse(optional($ballotItem->candidate)->name . " is already assigned.");
                }
            }

            DB::beginTransaction();

            $ballot = Ballot::updateOrCreate([
                'position_id' => $request->position_id,
                'vote_limit' => $request->vote_limit,
            ]);

            foreach ($request->candidates as $candidate) {
                $ballot->ballotItems()->updateOrCreate([
                    'candidate_id' => $candidate['id']
                ]);
            }
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            return static::makeErrorResponse($exception->getMessage());
        }

        DB::commit();

        return static::makeSuccessResponse('Record saved successfully.', [], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function singleBallot($id)
    {
        $this->authorize('read ballots');

        try {
            $settings = Setting::first();
            $ballot = Ballot::with('ballotItems')->find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.ballot.single-ballot', compact('settings', 'ballot'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function viewBallot()
    {
        $this->authorize('read ballots');

        try {
            $settings = Setting::first();
            $ballots = Ballot::with('ballotItems')->get();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.ballot.view-ballot', compact('ballots', 'settings'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update ballots');

        try {
            $ballot = Ballot::find($id);
            $positions = Position::all();
            $candidates = Candidate::all();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.ballot.edit', compact('ballot', 'positions', 'candidates'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update ballots');

        try {
            $rules = [];
            $rules['vote_limit'] = 'required';

            foreach ($request->candidates as $key => $val) {
                $rules['candidates.' . $key . '.id'] = 'required';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return static::makeErrorResponse('Please validate your form data.');
            }

            DB::beginTransaction();

            $ballot = Ballot::find($id);
            $ballot->vote_limit = $request->vote_limit;
            $ballot->update();

            foreach ($request->candidates as $candidate) {
                $ballot->ballotItems()->updateOrCreate([
                    'candidate_id' => $candidate['id']
                ]);
            }
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            return static::makeErrorResponse($exception->getMessage());
        }

        DB::commit();

        return static::makeSuccessResponse('Record Updated successfully.', [], 200, URL::previous(), 2000);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete ballots');

        try {
            $ballot = Ballot::find($id);
            $ballot->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyBallotItem($id)
    {
        $this->authorize('delete ballots');

        try {
            $ballotItem = BallotItem::find($id);
            $ballotItem->delete();
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return back()->with('success', 'Record deleted successfully.');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetAllBallots()
    {
        try {
            $ballots = Ballot::with('position', 'ballotItems')->get();

            foreach ($ballots as $ballot) {
                foreach ($ballot->ballotItems as $ballotItem) {
                    if (optional($ballotItem->candidate)->icon) {
                        $ballotItem->candidate->icon = get_uploaded_file_url($ballotItem->candidate->icon);
                    }
                }
            }
        } catch (\Exception $exception) {
            report($exception);
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully.', $ballots);
    }
}
