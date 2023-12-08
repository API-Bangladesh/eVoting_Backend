@extends('admin.layout.master')
@section('title', 'All Offline Tokens')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Offline Token List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        <span class="d-inline-block me-3">
                            Total Tokens:
                            <strong class="text-cyan">
                                {{ $offlineTokens->total() }}
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>S/L</th>
                            <th>Token No.</th>
                            <th>Member ID</th>
                            <th>Voter Name</th>
                            <th>Time In</th>
                            <th>Counter</th>
                            <th>Officer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offlineTokens as $key => $offlineToken)
                            <tr>
                                <td>{{ $key + $offlineTokens->firstItem() }}</td>
                                <td>{{ $offlineToken->token }}</td>
                                <td>{{ optional($offlineToken->voter)->member_id }}</td>
                                <td>{{ optional($offlineToken->voter)->name }}</td>
                                <td>{{ $offlineToken->created_at }} </td>
                                <td>{{ optional($offlineToken->counter)->counter_number }}</td>
                                <td>{{ optional(optional($offlineToken->counter)->counterOfficer)->name }}</td>
                                <td>
                                    @can('re-print offline-tokens')
                                        <a href="{{ route('re-print-offline-token', $offlineToken->id) }}"
                                           class="btn btn-secondary btn-sm" target="_blank">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $offlineTokens->links() }}

            </div>
        </div>
    </main>
@endsection
