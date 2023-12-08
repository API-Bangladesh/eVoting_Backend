<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read email-logs');

        try {
            $emailLogs = EmailLog::latest()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.email-log.index', compact('emailLogs'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $this->authorize('search email-logs');

        try {
            $query = EmailLog::query();

            if ($request->filled('keywords')) {
                $query->where('to', $request->get('keywords'));
                $query->orWhere('from', 'LIKE', '%' . $request->get('keywords') . '%');
                $query->orWhere('created_at', 'LIKE', '%' . $request->get('keywords') . '%');
            }

            $emailLogs = $query->latest()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.email-log.index', compact('emailLogs'));
    }
}
