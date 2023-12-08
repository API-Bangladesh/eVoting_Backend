<?php

namespace App\Http\Controllers;

use App\Http\Requests\CounterOfficerRequest;
use App\Models\CounterOfficer;

class CounterOfficerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read counter-officers');

        try {
            $counterOfficers = CounterOfficer::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.counter-officer.index', compact('counterOfficers'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create counter-officers');

        return view('admin.counter-officer.create');
    }

    /**
     * @param CounterOfficerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function store(CounterOfficerRequest $request)
    {
        $this->authorize('create counter-officers');

        try {
            CounterOfficer::create([
                'name' => $request->name,
                'info' => $request->info
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('success', 'Record saved successfully..');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update counter-officers');

        try {
            $counterOfficer = CounterOfficer::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.counter-officer.edit', compact('counterOfficer'));
    }

    /**
     * @param CounterOfficerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function update(CounterOfficerRequest $request, $id)
    {
        $this->authorize('update counter-officers');

        $inputs = $request->all();

        try {
            $counterOfficer = CounterOfficer::find($id);
            $counterOfficer->fill($inputs);
            $counterOfficer->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated Successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete counter-officers');

        try {
            $counter = CounterOfficer::find($id);
            $counter->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }
}
