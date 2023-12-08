<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize('read positions');

        try {
            $positions = Position::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.position.index', compact('positions'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('create positions');

        return view('admin.position.create');

    }

    /**
     * @param PositionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PositionRequest $request)
    {
        $this->authorize('create positions');

        try {
            Position::create([
                'name' => $request->name
            ]);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return back()->with('success', 'Record saved successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->authorize('update positions');

        try {
            $position = Position::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.position.edit', compact('position'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PositionRequest $request, $id)
    {
        $this->authorize('update positions');

        $inputs = $request->all();

        try {
            $position = Position::find($id);
            $position->fill($inputs);
            $position->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete positions');

        try {
            $position = Position::find($id);
            $position->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }
}
