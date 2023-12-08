@extends('admin.layout.master')
@section('title', 'All Roles')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Role List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Roles:
                        <strong class="text-cyan">
                            {{ $roles->total() }}
                        </strong>
                    </div>
                    @can('create roles')
                        <a href="{{ route('create-role') }}" type="button" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus me-1"></i> Add New
                        </a>
                    @endcan
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>S/L</th>
                            <th>Name</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($exceptRoles = [\App\Models\Role::TYPE_SUPER_ADMIN, \App\Models\Role::TYPE_ADMIN, \App\Models\Role::TYPE_OFFICER])
                        @foreach($roles as $key => $role)
                            <tr>
                                <td>{{ $key + $roles->firstItem() }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($role->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('assign-permissions roles')
                                        <a href="{{ route('edit-role-permissions', ['id' => $role->id]) }}"
                                           class="btn btn-primary text-light btn-sm" title="Assign Permissions">
                                            <i class="bi bi-lock"></i>
                                        </a>
                                    @endcan
                                    @unless(in_array($role->name, $exceptRoles))
                                        @can('update roles')
                                            <a href="{{ route('edit-role', $role->id) }}"
                                               class="btn btn-info text-light btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('delete roles')
                                            <a href="{{ route('delete-role', $role->id) }}"
                                               class="btn btn-danger btn-sm btnDeleteRecord">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endcan
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roles->links() }}
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
