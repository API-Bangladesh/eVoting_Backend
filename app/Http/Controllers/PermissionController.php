<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read permissions');

        try {
            $permissions = Permission::paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('create permissions');

        return view('admin.permission.create');
    }

    /**
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        $this->authorize('create permissions');

        try {
            Permission::create([
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
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update permissions');
        abort(500, "This function disable temporarily.");

        try {
            $permission = Permission::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->authorize('update permissions');
        abort(500, "This function disable temporarily.");

        $inputs = $request->all();

        try {
            $permission = Permission::find($id);
            $permission->fill($inputs);
            $permission->update();
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
        $this->authorize('delete permissions');
        abort(500, "This function disable temporarily.");

        try {
            $permission = Permission::find($id);
            $permission->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }
}
