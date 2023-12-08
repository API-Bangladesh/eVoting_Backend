<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Models\Ballot;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function onlineResultSlideshow()
    {
        $this->authorize('read voting-results');

        $totalOnlineVoters = Voter::where('is_online_voter', '1')->count();
        $totalOnlineVotes = Vote::count();

        return view('admin.result.online-result-slideshow', compact('totalOnlineVoters', 'totalOnlineVotes'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function offlineResultShow()
    {
        $this->authorize('read voting-results');

        $ballots = Ballot::with('position', 'ballotItems')->get();

        foreach ($ballots as $ballot) {
            foreach ($ballot->ballotItems as $ballotItem) {
                if (optional($ballotItem->candidate)->icon) {
                    $ballotItem->candidate->icon = get_uploaded_file_url($ballotItem->candidate->icon);
                }
            }
        }

        return view('admin.result.offline-result-show', compact('ballots'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function offlineVotingResult()
    {
        $this->authorize('upload-voting-results voting-results');

        try {
            $ballots = Ballot::with('ballotItems')->get();

            $counters = [
                'offline_voters' => Voter::whereNull('is_online_voter')->count()
            ];
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.result.upload-offline-voting-result', compact('ballots', 'counters'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function viewPrintableReport()
    {
        $this->authorize('read voting-results');

        try {
            // Fetch candidates
            $candidates = Candidate::all();

            // Set default votes "0"
            // according to candidate id as key
            $countCandidateVotes = [];
            foreach ($candidates as $candidate) {
                $countCandidateVotes[$candidate->id] = 0;
            }

            // Fetch votes
            $votes = Vote::all();
            foreach ($votes as $vote) {
                $candidate_ids = $vote->candidate_ids;
                if (empty($candidate_ids)) continue;

                // Increment vote count according to candidate id
                foreach ($candidate_ids as $candidate_id) {
                    $countCandidateVotes[$candidate_id] = $countCandidateVotes[$candidate_id] += 1;
                }
            }

            // Fetch all ballots
            $ballots = Ballot::with('position', 'ballotItems')->get();

            // Update ballot objects
            foreach ($ballots as $ballot) {
                foreach ($ballot->ballotItems as $ballotItem) {
                    if (optional($ballotItem->candidate)->icon) {
                        $ballotItem->candidate->icon = get_uploaded_file_url($ballotItem->candidate->icon);
                    }

                    // Merge online and offline votes
                    if (optional($ballotItem->candidate)->id) {
                        $ballotItem->candidate->offline_vote_count += $countCandidateVotes[$ballotItem->candidate->id];
                    }
                }
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.result.view-printable-report', compact('ballots'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOfflineVotingResult(Request $request)
    {
        $this->authorize('upload-voting-results voting-results');

        if (Setting::get('disable_offline_voting_result_upload')) {
            return back()->with('warning', "Record can't be updated, the service is locked.");
        }

        DB::beginTransaction();

        try {
            foreach ($request->candidate_ids as $candidate_id => $value) {
                $candidate = Candidate::find($candidate_id);
                $candidate->offline_vote_count = $value;
                $candidate->update();
            }

            if ($request->has('save_lock') && $request->filled('save_lock')) {
                $setting = Setting::instance();
                $setting->disable_offline_voting_result_upload = 1;
                $setting->update();
            }
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }
}
