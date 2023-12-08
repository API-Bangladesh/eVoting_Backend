@extends('admin.layout.master')
@section('title', 'All Counters')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Counter List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Counters:
                        <strong class="text-cyan">
                            {{ $counters->total() }}
                        </strong>
                    </div>
                    @can('create counters')
                        <a href="{{ route('create-counter') }}" type="button" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus me-1"></i> Add New
                        </a>
                    @endcan
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Counter Number</th>
                            <th>Name</th>
                            <th>Counter Officer</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($counters as $key => $counter)
                            <tr>
                                <td>{{ $key + $counters->firstItem() }}</td>
                                <td>{{ $counter->counter_number }}</td>
                                <td> {{ $counter->counter_name }} </td>
                                <td> {{ optional($counter->counterOfficer)->name }} </td>
                                <td>{{ \Carbon\Carbon::parse($counter->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('update counters')
                                        <a href="{{ route('edit-counter', $counter->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete counters')
                                        <a href="{{ route('delete-counter', $counter->id) }}"
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

                {{ $counters->links() }}

            </div>
        </div>
    </main>
@endsection
