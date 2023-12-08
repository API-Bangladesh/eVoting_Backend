@extends('admin.layout.master')
@section('title', 'Email Logs')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Email Logs</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Logs:
                        <strong class="text-cyan">
                            {{ $emailLogs->total() }}
                        </strong>
                    </div>
                    @can('search activity-logs')
                        <form action="{{ route('search-email-logs') }}" method="GET"
                              class="col-xl-4 form-group d-flex align-items-center gap-2 mb-3 mb-sm-0">
                            @csrf
                            <label for="keywords" class="flex-shrink-0">Search: </label>
                            <input type="search" name="keywords" value="{{ request()->get('keywords') }}"
                                   class="form-control rounded-pill flex-grow-1"
                                   id="keywords" placeholder="Search logs">
                        </form>
                    @endcan
                </div>
                <div class="voter-list table-responsive">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/L</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Status</th>
                                <th>Sent Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($emailLogs as $key => $emailLog)
                                <tr>
                                    <td>{{ $key + $emailLogs->firstItem() }}</td>
                                    <td>{{ $emailLog->to }}</td>
                                    <td>{{ $emailLog->subject }}</td>
                                    <td>
                                        <button type="button" class="btn btn-add-field btn-link btn-sm p-0"
                                                data-bs-toggle="modal"
                                                data-bs-target={{ '#showBodyContent_'. $emailLog->id }}>
                                            View Email
                                        </button>

                                        <div class="modal fade" id="{{ 'showBodyContent_'. $emailLog->id }}"
                                             aria-hidden="true"
                                             style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Email Body</h5>
                                                        <button type="button" class="btn btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $emailLog->body !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($emailLog->status == 1)
                                            <span class="bg-success px-2 rounded text-white">Success</span>
                                        @elseif($emailLog->status == 2)
                                            <span class="bg-danger px-2 rounded text-white">Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="mdi mdi-calendar"></i> {{ \Carbon\Carbon::parse($emailLog->created_at)->format('M d, Y') }}
                                        <br>
                                        <i class="mdi mdi-clock"></i> {{ \Carbon\Carbon::parse($emailLog->created_at)->format('h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $emailLogs->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </main>
@endsection
