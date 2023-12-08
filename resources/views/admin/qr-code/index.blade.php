@extends('admin.layout.master')
@section('title', 'All QR Codes')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">QR Codes</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0 d-flex align-items-center gap-3">
                        <span class="d-inline-block me-3">
                            Total Codes:
                            <strong class="text-cyan">
                                {{ $qrCodes->total() }}
                            </strong>
                        </span>
                        @if(count($qrCodes) > 0)
                            @can('lock qr-codes')
                                <a href="{{ route('lock-qr-code') }}" id="btn-lock-qr-codes"
                                   class="btn btn-primary btn-sm px-3 rounded-pill @if(setting()->get('lock_qr_code')) disabled @endif">
                                    <i class="bi bi-lock me-1"></i> {{ (setting()->get('lock_qr_code')) ? 'Locked' : 'Lock Qr Code' }}
                                </a>
                            @endcan
                            @if(setting()->get('lock_qr_code'))
                                <p class="mb-0 d-inline-block mt-1">
                                    {{ setting()->get('updated_at') }}
                                </p>
                            @endif
                        @endif
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
                                            <a href="{{ route('download-qr-codes-pdf', ['start' => $fileData['start'], 'end' => $fileData['end'], 'limit' => $fileData['limit']]) }}"
                                               type="button" target="_blank"
                                               class="btn btn-danger btn-sm mb-1">
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
                        @can('export qr-codes')
                            @if(setting()->get('lock_qr_code'))
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exportPDF">
                                    <i class="bi bi-download me-1"></i>
                                    Export PDF
                                </button>
                            @endif
                        @endcan
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Code</th>
                            <th>QR Code</th>
                            <th>BarCode</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qrCodes as $key => $qrCode)
                            <tr>
                                <td>{{ $key + $qrCodes->firstItem() }}</td>
                                <td>{{ $qrCode->code }}</td>
                                <td>{!! QrCode::size(50)->generate($qrCode->code) !!}</td>
                                <td>{!! DNS1D::getBarcodeHTML($qrCode->code, 'C39') !!}</td>
                                <td>
                                    @if($qrCode->is_used == 1)
                                        <span class="bg-success text-white rounded px-1">
                                           Used
                                        </span>
                                    @else
                                        <span class="bg-secondary text-white rounded px-1">
                                            Not Used
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $qrCodes->links() }}

            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            $('#btn-lock-qr-codes').on('click', function (e) {
                let confirm = prompt("Type 'LOCK' to confirm. \nLock the qr-code generation after confirm.");
                if (confirm !== null) {
                    if (confirm !== 'LOCK') {
                        e.preventDefault();
                        e.stopPropagation();
                        return;
                    }
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
            });
        });
    </script>
@endsection
