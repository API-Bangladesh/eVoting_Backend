@extends('admin.layout.master')
@section('title', 'Application')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Submission List</h3>

            @include('common.alert-message')

            <form action="{{ route('batch-update-application-status') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="mb-0">
                            Total Submissions:
                            <strong class="text-cyan">
                                {{ count($applications) }}
                            </strong>
                        </div>
                        <div class="export-data d-flex align-items-center gap-2">
                            <div class="modal fade" id="exportPDF" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Exportable Files Pagination
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($filesOffsetData as $fileData)
                                                <a href="{{ route('download-application-list-pdf', ['start' => $fileData['start'], 'end' => $fileData['end'], 'limit' => $fileData['limit']]) }}"
                                                   type="button" target="_blank"
                                                   class="btn btn-warning btn-sm mb-1">
                                                    {{ $fileData['start'] }} - {{ $fileData['end'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('export-submissions applications')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exportPDF">
                                    <i class="bi bi-download me-1"></i>
                                    Export PDF
                                </button>
                            @endcan
                        </div>
                    </div>

                    <div class="voter-list table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>#SL</th>
                                <th>member ID</th>
                                <th>Voter Name</th>
                                <th>Email Address</th>
                                <th>Form Data</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $key => $application)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $application->id }}"
                                               @if(in_array($application->id, old('ids', []))) checked @endif/>
                                    </td>
                                    <td>{{ $key + $applications->firstItem() }}</td>
                                    <td>{{ $application->form_data['member_id'] }}</td>
                                    <td>{{ $application->form_data['name'] }}</td>
                                    <td>{{ $application->form_data['email'] }}</td>
                                    <td>
                                        <div style="width: 250px;">
                                            @foreach($application->form_data as $key => $value)
                                                <kbd class="d-inline-block mb-1">
                                                    {{ \Illuminate\Support\Str::title($key) }}: {{ $value }}
                                                </kbd>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y') }}</td>
                                    <td>
                                        @can('approve-submissions applications')
                                            <a href="{{ route('approve-application', $application->voter_id) }}"
                                               type="button" title="Approve Submission"
                                               class="btn btn-success btn-sm @if($application->is_approved == 1) disabled opacity-25 @endif">
                                                <i class="bi bi-check2-circle"></i>
                                            </a>
                                        @endcan
                                        @can('decline-submissions applications')
                                            <a href="{{ route('decline-application', $application->voter_id) }}"
                                               type="button" title="Declined Submission"
                                               class="btn btn-decline-modal @if($application->is_declined == 1) disabled opacity-25 @endif btn-danger btn-sm"
                                               data-voter-id={{ $application->voter_id }}>
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2 align-items-center">
                        @can('approve-submissions applications')
                            <div class="col-xl-7">
                                <div class="form-group d-flex flex-wrap align-items-center gap-1">
                                    <label for="batch_actions" class="form-label mb-0 me-2 fw-bold flex-shrink-0">
                                        Batch Actions:
                                    </label>
                                    <select class="form-control flex-grow-1" name="batch_actions" id="batch_actions"
                                            style="max-width: 200px;">
                                        <option disabled selected>Select an option</option>
                                        <option @if(old('batch_actions') == 'approved') selected
                                                @endif value="approved">
                                            Approved
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        @endcan
                        <div class="col-xl-5">
                            {{ $applications->links() }}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- Declined Messaging Modal --}}
    <div class="modal fade" id="reason-to-decline" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason to decline</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="" class="add-field-form modal-body px-5" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-2">
                        <textarea class="form-control" name="reason" id="" cols="30" rows="5"
                                  placeholder="Write here...">Thank you for the applying for online but we are sorry you are not approved as an online voter. Please cast your vote physically at voting center. </textarea>
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 btn-sm">
                            Send Mail
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('.voter-list').on('click', '.btn-decline-modal', function (e) {
                e.preventDefault();
                let voterId = $(this).data('voter-id') || null;

                if (voterId !== null) {
                    let actionURL = '{!! route('decline-application', '') !!}' + '/' + voterId;

                    $('form.add-field-form').attr('action', actionURL);
                    $('#reason-to-decline').modal('toggle');
                } else {
                    return $('form.add-field-form').attr('action', '/');
                }
            });
        });
    </script>
@endsection
