@extends('admin.layout.master')
@section('title', 'All Counter Officers')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Counter Officer List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Officers:
                        <strong class="text-cyan">
                            {{ $counterOfficers->total() }}
                        </strong>
                    </div>
                    @can('create counter-officers')
                        <a href="{{ route('create-counter-officer') }}" type="button" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus me-1"></i> Add New
                        </a>
                    @endcan
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#ID</th>
                            <th>Officer Name</th>
                            <th>Other Info</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($counterOfficers as $key => $counterOfficer)
                            <tr>
                                <td>{{ $key + $counterOfficers->firstItem() }}</td>
                                <td> {{ $counterOfficer->name }} </td>
                                <td>{{ $counterOfficer->info ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($counterOfficer->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('update counter-officers')
                                        <a href="{{ route('edit-counter-officer', $counterOfficer->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete counter-officers')
                                        <a href="{{ route('delete-counter-officer', $counterOfficer->id) }}"
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

                {{ $counterOfficers->links() }}

            </div>
        </div>
    </main>
@endsection
