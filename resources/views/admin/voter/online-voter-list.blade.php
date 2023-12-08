@extends('admin.layout.master')
@section('title', 'All Online Voters')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Online Voter List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        <span class="d-inline-block me-3">
                            Total Voters:
                            <strong class="text-cyan">
                                {{ $onlineVoters->total() }}
                            </strong>
                        </span>

                        @can('generate tokens')
                            @if(count($onlineVoters) > 0)
                                <a href="{{ route('generate-tokens') }}" type="button"
                                   class="btn btn-primary btn-sm px-3 rounded-pill @if(setting()->get('lock_online_token')) disabled @endif"> {{ (setting()->get('lock_online_token')) ? 'Generated' : 'Generate Tokens'}} </a>
                                @if(setting()->get('lock_online_token'))
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
                        @foreach($onlineVoters as $key => $onlineVoter)
                            <tr>
                                <td>{{ $onlineVoter->id }}</td>
                                <td>{{ $onlineVoter->member_id }}</td>
                                <td>{{ $onlineVoter->name }}</td>
                                <td>{{ $onlineVoter->email_address }}</td>
                                <td>{{ $onlineVoter->contact_number }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $onlineVoters->links() }}
            </div>
        </div>
    </main>
@endsection
