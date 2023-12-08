@extends('admin.layout.master')
@section('title', 'All Users')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">User List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Users:
                        <strong class="text-cyan">
                            {{ $users->total() }}
                        </strong>
                    </div>
                    <div class="export-data d-flex align-items-center gap-2">
                        @can('create users')
                            <a href="{{ route('create-user') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus me-1"></i> Add New
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $key + $users->firstItem() }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->roles->pluck('name') }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @if(empty($user->deleted_at))
                                        @can('update users')
                                            <a href="{{ route('edit-user', $user->id) }}" type="button"
                                               class="btn btn-info text-light btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('trash users')
                                            <a href="{{ route('trash-user', $user->id) }}" type="button"
                                               class="btn btn-danger btn-sm btnTrashRecord" title="Move to Trash">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endcan
                                    @else
                                        @can('restore users')
                                            <a href="{{ route('restore-user', $user->id) }}" type="button"
                                               class="btn btn-primary btn-sm mr-2 btnRestoreRecord" title="Restore">
                                                <i class="bi bi-recycle"></i>
                                            </a>
                                        @endcan
                                        @can('delete users')
                                            <a href="{{ route('delete-user', $user->id) }}" type="button"
                                               class="btn btn-danger btn-sm btnDeleteRecord">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $users->links() }}

            </div>
        </div>
    </main>
@endsection
