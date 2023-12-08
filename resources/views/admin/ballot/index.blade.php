@extends('admin.layout.master')
@section('title', 'All Ballots')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Ballot List</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Ballots:
                        <strong class="text-cyan">
                            {{ $ballots->total() }}
                        </strong>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @can('create ballots')
                        <a href="{{ route('create-ballot') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus me-1"></i> Add New
                        </a>
                        @endcan
                        @if(is_enable_online_voting_function())
                            <div class="btn-group" role="group">
                                <a href="{{ setting()->get('online_voting_url') }}"
                                   class="btn btn-add-field btn-info btn-sm" target="_blank">
                                    <i class="bi bi-view-list me-1"></i> Voting Link
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Position</th>
                            <th>Candidates</th>
                            <th>Vote Limit</th>
                            <th>View</th>
                            <th>Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ballots as $key => $ballot)
                            <tr>
                                <td>{{ $key + $ballots->firstItem() }}</td>
                                <td>{{ optional($ballot->position)->name }}</td>
                                <td>
                                    @foreach($ballot->ballotItems as $ballotItem)
                                        <kbd>{{ optional($ballotItem->candidate)->name }}</kbd>
                                    @endforeach
                                </td>
                                <td>
                                    <strong class="border border-warning rounded py-1 px-2">
                                        {{ $ballot->vote_limit }}
                                    </strong>
                                </td>
                                <td>
                                    <a href="{{ route('single-ballot', $ballot->id) }}" class="btn btn-light"
                                       title="View Single Ballot" target="_blank">
                                        View Ballot
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($ballot->updated_at)->format('d M, Y') }}</td>
                                <td>
                                    @can('update ballots')
                                        <a href="{{ route('edit-ballot', $ballot->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete ballots')
                                        <a href="{{ route('delete-ballot', $ballot->id) }}"
                                           class="btn btn-danger btn-sm btnDeleteRecord" title="Delete">
                                            <i class="bi bi-x"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="pagination-nav d-flex flex-wrap align-items-center justify-content-between mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" @if(setting()->get('ballot_merge_all')) checked
                               @endif id="merge"/>
                        <label class="form-check-label" for="merge">
                            Merge All
                        </label>
                    </div>

                    {{ $ballots->links() }}

                </nav>
                <div id="btn-view-ballots"
                     class="view-ballots @if(setting()->get('ballot_merge_all'))  d-block @else d-none @endif mt-2 text-lg-end">
                    <a href="{{route('view-ballot')}}" class="btn btn-primary px-4 rounded-pill"
                       title="View Merged Ballots" target="_blank">
                        View Ballots
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $('#merge').on('change', function () {
            let check_status = $(this).is(':checked');
            if (check_status === true) {
                $('#btn-view-ballots').removeClass('d-none');

            } else {
                $('#btn-view-ballots').addClass('d-none');
            }
            $.ajax({
                type: 'POST',
                url: '/merge-ballot',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'data': check_status
                },
                success: function (data) {
                    console.log(data);
                }
            });
        })
    </script>
@endsection
