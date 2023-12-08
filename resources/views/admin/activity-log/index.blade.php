@extends('admin.layout.master')
@section('title', 'Activity Logs')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Activity Logs</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Logs:
                        <strong class="text-cyan">
                            {{ $activityLogs->total() }}
                        </strong>
                    </div>
                    @can('search activity-logs')
                        <form action="{{ route('search-activity-logs') }}" method="GET"
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
                                <th>Log Name</th>
                                <th>Description</th>
                                <th>Changes Objects</th>
                                <th>Log Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($activityLogs as $key => $activityLog)
                                <tr>
                                    <td>{{ $key + $activityLogs->firstItem() }}</td>
                                    <td>{{ $activityLog->log_name }}</td>
                                    <td>{{ $activityLog->description }}</td>
                                    <td>
                                        <code
                                                style="font-size: 12px; max-width: 600px; max-height: 120px; overflow-x: hidden; overflow-y: scroll; display: block;">
                                            {{ $activityLog->properties }}
                                        </code>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-calendar"></i> {{ \Carbon\Carbon::parse($activityLog->created_at)->format('d M, Y') }}
                                        <br>
                                        <i class="mdi mdi-clock"></i> {{ \Carbon\Carbon::parse($activityLog->created_at)->format('h:i:s A') }}
                                        <br>
                                        <i class="mdi mdi-account-box"></i> {{ $activityLog->causer->name ?? __('No Name') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $activityLogs->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </main>
@endsection
