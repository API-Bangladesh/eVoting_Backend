<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read activity-logs');

        try {
            $activityLogs = ActivityLog::latest()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.activity-log.index', compact('activityLogs'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $this->authorize('search activity-logs');

        try {
            $query = ActivityLog::query();

            if ($request->filled('keywords')) {
                $query->where('id', 'LIKE', $request->get('keywords'));
                $query->orWhere('log_name', 'LIKE', $request->get('keywords'));
                $query->orWhere('description', 'LIKE', '%' . $request->get('keywords') . '%');
                $query->orWhere('properties', 'LIKE', '%' . $request->get('keywords') . '%');
            }

            $activityLogs = $query->latest()->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.activity-log.index', compact('activityLogs'));
    }
}
