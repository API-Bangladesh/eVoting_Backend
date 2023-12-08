<?php

namespace App\Http\Controllers;

use App\Models\CounterOfficer;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $this->authorize('read users');

        try {
            $users = User::withTrashed()->whereNotIn('username', ['superadmin', auth()->user()->username])->paginate();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function create()
    {
        $this->authorize('create users');

        try {
            $user = new User();
            $user->username = '';
            $user->name = '';
            $user->email = '';
            $user->password = '';

            $permissions = [];
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.user.create', compact('user', 'permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create users');

        DB::beginTransaction();

        try {
            if ($request->is_create_officer) {
                $rules = [];
                $rules['counter_officer_id'] = 'required|unique:users,counter_officer_id,' . $request->id;
                $rules['password'] = 'required|min:6';
                $rules['role_id'] = 'required';

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $counterOfficer = CounterOfficer::find($request->counter_officer_id);

                $username = preg_replace('/[^A-Za-z0-9\-]/', '', $counterOfficer->name);
                $username = strtolower($username);

                // Check if username exists
                if (User::where('username', $counterOfficer->name)->exists()) {
                    return back()->with('warning', 'This user is already exists.');
                }

                $user = User::create([
                    'username' => $username,
                    'name' => $counterOfficer->name,
                    'email' => $username . '@officer.com',
                    'password' => bcrypt($request->password),
                    'counter_officer_id' => $counterOfficer->id,
                ]);
            } else {
                $rules = [];
                $rules['username'] = 'required|unique:users,username,' . $request->id;
                $rules['email'] = 'required|email|unique:users,email,' . $request->id;
                $rules['password'] = 'required|min:6';
                $rules['role_id'] = 'required';

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $user = User::create([
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            }

            // Bind role
            $role = Role::findById($request->role_id);
            $user->syncRoles($role);
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return redirect('/edit-user/' . $user->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function edit($id)
    {
        $this->authorize('update users');

        try {
            $user = User::find($id);
            $permissions = $user->permissions()->pluck('name')->toArray();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.user.edit', compact('user', 'permissions'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update users');

        DB::beginTransaction();

        try {
            $rules = [];
            $rules['username'] = 'required';
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['role_id'] = 'required';

            if ($request->filled('password')) {
                $rules['password'] = 'min:6';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->update();

            // Bind role
            $role = Role::findById($request->role_id);
            $user->syncRoles($role);

            $permissions = $request->permissions;

            // Bind permissions
            if ($permissions && count($permissions) > 0) {
                foreach ($permissions as $permission) {
                    Permission::updateOrCreate([
                        'name' => $permission
                    ]);
                }
            }

            $user->syncPermissions($permissions);
        } catch (\Exception $exception) {
            report($exception);

            DB::rollBack();

            abort(500, $exception->getMessage());
        }

        DB::commit();

        return back()->with('info', 'Record updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function trash($id)
    {
        $this->authorize('trash users');

        try {
            $user = User::whereNotIn('id', ['1'])->findOrFail($id);
            $user->delete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record trashed successfully.', [], 200, route('user-list'), 3000);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $this->authorize('restore users');

        try {
            $user = User::withTrashed()->whereNotIn('id', ['1'])->findOrFail($id);
            $user->restore();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record trashed successfully.', [], 200, route('user-list'), 3000);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->authorize('delete users');

        try {
            $user = User::withTrashed()->whereNotIn('id', ['1'])->findOrFail($id);
            remove_file($user->image);
            $user->forceDelete();
        } catch (\Exception $exception) {
            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record deleted successfully.', [], 200, route('user-list'), 3000);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function profile($id)
    {
        $this->authorize('update-profile users');

        try {
            $user = User::with('counterOfficer')->find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return view('admin.user.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateProfile(Request $request, $id)
    {
        $this->authorize('update-profile users');

        try {
            $rules = [];
            $rules['username'] = 'required';
            $rules['name'] = 'required';
            $rules['email'] = 'required';
            $rules['image'] = 'nullable|file|mimes:jpeg,jpg,png|max:5120';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->image = do_upload_file($request, 'image', 'old_image');
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return back()->with('info', 'Record updated successfully.');
    }
}
