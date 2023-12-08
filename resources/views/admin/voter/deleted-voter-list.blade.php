@extends('admin.layout.master')
@section('title', 'All Deleted Voters')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Deleted Voter List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Voters:
                        <strong class="text-cyan">
                            {{ $voters->total() }}
                        </strong>
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Voter ID</th>
                            <th>category</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($voters as $key => $voter)
                            <tr>
                                <td>{{ $voter->id }}</td>
                                <td>{{ $voter->name }}</td>
                                <td>{{ $voter->member_id }}</td>
                                <td>{{ $voter->category }}</td>
                                <td>{{ $voter->email_address }}</td>
                                <td>{{ $voter->contact_number }}</td>
                                <td>
                                    @can('trash voters')
                                        <a href="{{ route('restore-voter', $voter->id) }}"
                                           class="btn btn-primary btn-sm mr-2 btnRestoreRecord" title="Restore">
                                            <i class="bi bi-recycle"></i>
                                        </a>
                                    @endcan
                                    @can('delete voters')
                                        @if(setting()->get('disable_permanently_voters_deletion') != 1)
                                            <a href="{{ route('delete-voter', $voter->id) }}"
                                               class="btn btn-danger btn-sm btnDeleteRecord" title="Delete Permanently">
                                                <i class="bi bi-x ml-5"></i>
                                            </a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $voters->links() }}
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
