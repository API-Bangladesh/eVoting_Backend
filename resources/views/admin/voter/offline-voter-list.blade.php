@extends('admin.layout.master')
@section('title', 'All Offline Voters')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Offline Voter List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        <span class="d-inline-block me-3">
                            Total Voters:
                            <strong class="text-cyan">
                                {{ $offlineVoters->total() }}
                            </strong>
                        </span>
                        @can('generate qr-codes')
                            @if(count($offlineVoters) > 0)
                                <a href="{{ route('generate-qr-codes') }}"
                                   class="btn btn-primary btn-sm px-3 rounded-pill @if(setting()->get('lock_qr_code')) disabled @endif "> {{ (setting()->get('lock_qr_code')) ? 'Generated' : 'Generate Unique Code ' }}</a>
                                @if(setting()->get('lock_qr_code'))
                                    <span>{{ setting()->get('updated_at') }}</span>
                                @endif
                            @endif
                        @endcan

                        @include('common.alert-message')

                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#ID</th>
                            <th>Member ID</th>
                            <th>Voter Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offlineVoters as $key => $offlineVoter)
                            <tr>
                                <td>{{ $offlineVoter->id }}</td>
                                <td>{{ $offlineVoter->member_id }}</td>
                                <td>{{ $offlineVoter->name }}</td>
                                <td>{{ $offlineVoter->email_address }}</td>
                                <td>{{ $offlineVoter->contact_number }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $offlineVoters->links() }}

            </div>
        </div>
    </main>
@endsection
