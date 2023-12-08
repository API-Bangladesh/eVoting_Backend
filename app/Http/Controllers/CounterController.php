<?php

namespace App\Http\Controllers;

use App\Http\Requests\CounterRequest;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read counters');

        try {
            $counters = Counter::with('counterOfficer')->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.counter.index', compact('counters'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create counters');

        return view('admin.counter.create');
    }

    /**
     * @param CounterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function store(CounterRequest $request)
    {
        $this->authorize('create counters');

        try {
            Counter::create([
                'counter_number' => $request->counter_number,
                'counter_name' => $request->counter_name,
                'counter_officer_id' => $request->counter_officer_id
            ]);
        } catch (\Exception $exception) {
            throw $exception;
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
        $this->authorize('update counters');

        try {
            $counter = Counter::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.counter.edit', compact('counter'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update counters');

        $inputs = $request->all();

        try {
            $counter = Counter::find($id);
            $counter->fill($inputs);
            $counter->update();
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
        $this->authorize('delete counters');

        try {
            $counter = Counter::find($id);
            $counter->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }
}
