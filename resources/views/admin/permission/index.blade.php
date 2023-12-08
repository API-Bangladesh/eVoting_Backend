@extends('admin.layout.master')
@section('title', 'All Permissions')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Permission List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Permissions:
                        <strong class="text-cyan">
                            {{ $permissions->total() }}
                        </strong>
                    </div>
                    @can('create permissions')
                        <a href="{{ route('create-permission') }}" type="button" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus me-1"></i> Add New
                        </a>
                    @endcan
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Modified</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $key => $permission)
                            <tr>
                                <td>{{ $key + $permissions->firstItem() }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $permissions->links() }}
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
