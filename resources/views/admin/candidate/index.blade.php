@extends('admin.layout.master')
@section('title', 'All Candidates')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Candidate List</h3>

            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Candidates:
                        <strong class="text-cyan">
                            {{ $candidates->total() }}
                        </strong>
                    </div>
                    <div class="export-data d-flex align-items-center gap-2">
                        @can('create candidates')
                            <a href="{{ route('create-candidate') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus me-1"></i> Add New
                            </a>
                        @endcan
                        @can('export candidates')
                            <a href="{{ route('export-candidate-list-excel') }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Icon</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($candidates as $key => $candidate)
                            <tr>
                                <td>{{ $key + $candidates->firstItem() }}</td>
                                <td>{{ $candidate->name }}</td>
                                <td>{{ optional(optional(optional($candidate->ballotItem)->ballot)->position)->name ?? 'N/A' }}</td>
                                <td><img src="{{ get_uploaded_file_url($candidate->icon) }}"></td>
                                <td>{{ \Carbon\Carbon::parse($candidate->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('update candidates')
                                        <a href="{{ route('edit-candidate', $candidate->id) }}"
                                           class="btn btn-info text-light btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete candidates')
                                        <a href="{{ route('delete-candidate', $candidate->id) }}"
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
                {{ $candidates->links() }}
            </div>
        </div>
    </main>
@endsection
