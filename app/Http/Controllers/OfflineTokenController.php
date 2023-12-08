<?php

namespace App\Http\Controllers;

use App\Facades\Setting;
use App\Http\Requests\OfflineTokenRequest;
use App\Models\Counter;
use App\Models\OfflineToken;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class OfflineTokenController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read offline-tokens');

        try {
            $offlineTokens = OfflineToken::latest()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.offline-token.index', compact('offlineTokens'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('create offline-tokens');

        try {
            $query = Voter::query();
            $query->whereNull('is_online_voter');
            $query->whereDoesntHave('offlineToken');

            $offlineVoters = $query->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.offline-token.create', compact('offlineVoters'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(OfflineTokenRequest $request)
    {
        $this->authorize('create offline-tokens');

        try {
            // Fetch voter
            $query = Voter::query();
            $query->where('member_id', $request->member_id);
            $query->where('contact_number', $request->phone);
            $query->whereNull('is_online_voter');
            $voter = $query->first();

            if (empty($voter)) {
                return back()->with("warning", "Invalid phone number.");
            }

            // Fetch counter
            $query = Counter::query();
            $query->where('counter_number', optional(optional(optional(Auth::user())->counterOfficer)->counter)->counter_number);
            $counter = $query->first();

            // Is token exist
            $isExistToken = OfflineToken::where('voter_id', $voter->id)->exists();

            if (empty($voter) || empty($counter) || $isExistToken || ($request->secret_code != Setting::get('officer_secret_code'))) {
                return back()->with('warning', 'Invalid form request.');
            }

            $offlineToken = OfflineToken::create([
                'voter_id' => $voter->id,
                'counter_id' => $counter->id,
                'card_no' => $request->card_no,
                'token' => Str::upper(Str::random(6)),
                'phone' => $request->phone,
            ]);

            // Update checked in
            $voter->is_checked_in = 1;
            $voter->update();

            setcookie('download', 1, time() + (60 * 60), '/');

            $pdf = PDF::loadView('admin.offline-token.download-token-pdf', compact('offlineToken'));
            $pdf->setPaper([0, 0, 3.0 * 72, 11.7 * 72]);
            return $pdf->download('OFFLINE-TOKEN-' . $voter->member_id . '-' . now() . '.pdf');
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $this->authorize('search offline-tokens');

        try {
            $query = Voter::query();
            $query->whereNull('is_online_voter');
            $query->whereDoesntHave('offlineToken');

            if ($request->has('keywords') && $request->filled('keywords')) {
                $query->where('member_id', 'LIKE', "%" . $request->keywords . "%");
                $query->orWhere('name', 'LIKE', "%" . $request->keywords . "%");
                $query->orWhere('email_address', 'LIKE', "%" . $request->keywords . "%");
                $query->orWhere('contact_number', 'LIKE', "%" . $request->keywords . "%");
            }

            $offlineVoters = $query->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.offline-token.create', compact('offlineVoters'));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function rePrint($id)
    {
        $this->authorize('re-print offline-tokens');

        try {
            $offlineToken = OfflineToken::with('voter')->findOrFail($id);

            $pdf = PDF::loadView('admin.offline-token.download-token-pdf', compact('offlineToken'));
            $pdf->setPaper([0, 0, 3.0 * 72, 11.7 * 72]);
            return $pdf->stream('OFFLINE-TOKEN-' . $offlineToken->voter->member_id . '-' . now() . '.pdf');
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
