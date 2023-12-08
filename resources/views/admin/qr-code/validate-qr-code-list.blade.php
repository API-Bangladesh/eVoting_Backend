@extends('admin.layout.master')
@section('title', 'All Validated QR Codes')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Validate Ballot Scan</h3>

            @include('common.alert-message')

            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="row align-items-center justify-content-between mb-4">
                    <form action="{{ route('validate-qr-code') }}" method="POST" autocomplete="off"
                          class="col-xl-6 form-group d-flex align-items-center gap-2 mb-3 mb-sm-0">
                        @csrf
                        <label for="scan_input" class="flex-shrink-0">Scanner Input: </label>
                        <i class="bi bi-upc-scan"></i>
                        <input type="password" name="scan_input" class="form-control rounded-pill flex-grow-1"
                               id="scan_input" placeholder="Cursor should be pointed here.." autocomplete="off"
                               autofocus/>
                    </form>
                    <div class="col-xl-6 text-end">
                        <span class="d-inline-block me-3">
                            Validated:
                            <strong class="text-success">
                                {{ $counts['validated'] ?? 0 }}
                            </strong>
                        </span>
                        <span class="d-inline-block me-3">
                            Not Validated:
                            <strong class="text-secondary">
                                {{ $counts['notValidated'] ?? 0 }}
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Checked By</th>
                            <th>Status</th>
                            <th>Blank Ballot Scan Date-Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qrCodes as $key => $qrCode)
                            <tr>
                                <td>{{ $key + $qrCodes->firstItem() }}</td>
                                <td>{{ optional($qrCode->validatedBy)->name }}</td>
                                <td>
                                    @if(empty($qrCode->scan_blank_ballot))
                                        <span class="bg-secondary text-white rounded px-1">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-success text-white rounded px-1">
                                           Validated
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $qrCode->scan_blank_ballot }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $qrCodes->links() }}

            </div>
        </div>
    </main>
@endsection
