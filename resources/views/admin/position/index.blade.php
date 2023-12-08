@extends('admin.layout.master')
@section('title', 'All Positions')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Position List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Positions:
                        <strong class="text-cyan">
                            {{ $positions->total() }}
                        </strong>
                    </div>
                    @can('create positions')
                        <a href="{{ route('create-position') }}" type="button" class="btn btn-primary btn-sm">
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($positions as $key => $position)
                            <tr>
                                <td>{{ $key + $positions->firstItem() }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($position->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('update positions')
                                        <a href="{{ route('edit-position', $position->id) }}"
                                           class="btn btn-info text-light btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete positions')
                                        <a href="{{ route('delete-position', $position->id) }}"
                                           class="btn btn-danger btn-sm btnDeleteRecord">
                                            <i class="bi bi-x"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $positions->links() }}
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
