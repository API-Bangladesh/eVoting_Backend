@extends('admin.layout.master')
@section('title', 'All Email Templates')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="fs-3 fw-normal mb-4">All Email Templates</h3>
                    <div class="eVote-table p-4 is-drop-shadow bg-white rounded ">
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>#SL</th>
                                    <th>Category</th>
                                    <th>Subject</th>
                                    <th>Counter</th>
                                    <th>Sent Logs</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emailTemplates as $key => $emailTemplate)
                                    <tr>
                                        <td>{{ $key + $emailTemplates->firstItem() }}</td>
                                        <td>{{ get_email_category_name($emailTemplate->category_id) }}</td>
                                        <td>{{ $emailTemplate->subject }}</td>
                                        <td>{{ $emailTemplate->counter ?? 0 }}</td>
                                        <td>{!! implode('<br>', is_json($emailTemplate->sent_logs) ? json_decode($emailTemplate->sent_logs, true) : []) !!}</td>
                                        <td>
                                            @can('update email-templates')
                                                <a href="{{ route('edit-email-template', $emailTemplate->id) }}"
                                                   class="btn btn-sm btn-warning text-light" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('send email-templates')
                                                <a href="{{ route('send-email-by-category', $emailTemplate->id) }}"
                                                   class="btn btn-sm btn-primary" title="Send"
                                                   onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-send"></i>
                                                </a>
                                            @endcan
                                            @can('delete email-templates')
                                                <a href="{{ route('delete-email-template', $emailTemplate->id) }}"
                                                   class="btn btn-sm btn-danger text-light btnDeleteRecord"
                                                   title="Delete">
                                                    <i class="bi bi-x"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
