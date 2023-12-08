<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read roles');

        try {
            $roles = Role::whereNotIn('name', [Role::TYPE_SUPER_ADMIN])->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.role.index', compact('roles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('create roles');

        return view('admin.role.create');
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create roles');

        try {
            Role::create([
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
        $this->authorize('update roles');

        try {
            $role = Role::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.role.edit', compact('role'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(RoleRequest $request, $id)
    {
        $this->authorize('update roles');

        $inputs = $request->all();

        try {
            $role = Role::find($id);
            $role->fill($inputs);
            $role->update();
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
        $this->authorize('delete roles');

        try {
            $role = Role::whereNotIn('name', [Role::TYPE_SUPER_ADMIN, Role::TYPE_ADMIN, Role::TYPE_OFFICER])->findOrFail($id);
            $role->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function editRolePermissions($id)
    {
        $this->authorize('assign-permissions roles');

        try {
            $role = Role::findOrFail($id);
            $permissionList = get_generated_permissions();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.role.permissions', compact('role', 'permissionList'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateRolePermissions(Request $request, $id)
    {
        $this->authorize('assign-permissions roles');

        $inputs = $request->all();
        $permissions = $inputs['permissions'] ?? [];

        try {
            $role = Role::findOrFail($id);
            $role->syncPermissions($permissions);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }
}
