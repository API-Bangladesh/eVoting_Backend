@extends('admin.layout.master')
@section('title', 'Offline Voting Result')

@section('content')
    <style type="text/css">
        @media print {
            body * {
                visibility: hidden;
            }

            .section-to-print, .section-to-print * {
                visibility: visible;
            }

            .section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }

            .section-to-print .row {
                display: flex;
                justify-content: space-between;
            }

            .section-to-print .row .col-sm-4 {
                width: 33.33333333%;
                border: 1px solid #dddddd;
                border-right: none;
            }

            .section-to-print .row .col-sm-4:last-child {
                border-right: 1px solid #dddddd;
            }
        }
    </style>
    <main id="dashboard" class="section-to-print">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Offline Voting Result</h3>
            <div class="p-4 py-5 is-drop-shadow bg-white rounded">
                <div class="row justify-content-center pt-3">
                    <div class="col-sm-4 mb-4 mb-sm-0">
                        <div class="p-2 py-4 p-xl-4 bg-primary d-flex align-items-center bg-gradient rounded h-100">
                            <p class="mb-0 fs-5 text-light text-center w-100">
                                Total Valid Ballots
                                <br>
                                <strong>{{ get_count_offline_voters() }}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-4 mb-sm-0">
                        <div class="p-2 py-4 p-xl-4 bg-success d-flex align-items-center bg-gradient rounded h-100">
                            <p class="mb-0 fs-5 text-light text-center w-100">
                                Total Voted Ballots
                                <br>
                                <strong>{{ get_count_offline_casted_votes() }}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-4 mb-sm-0">
                        <div class="p-2 py-4 p-xl-4 bg-danger d-flex align-items-center bg-gradient rounded h-100">
                            <p class="mb-0 fs-5 text-light text-center w-100">
                                Total Invalid Ballots/Absent Voters
                                <br>
                                <strong>{{ get_count_offline_absent_voters() }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div id="result" class="result bg-white p-3 p-md-4">
                    <div class="row gx-5">
                        <div class="col-xl-12">
                            <div class="ballots-body">
                                <div class="pt-5">
                                    <div class="pt-1">
                                        <h4 class="fs-3 fw-normal mb-4">Vote Count</h4>
                                    </div>
                                </div>

                                @foreach($ballots as $ballot)
                                    <div class="ballots-widget mb-4">
                                        <h3 class="fs-6 fw-normal pb-2 b border-bottom mb-4">
                                            Vote Count for <strong>{{ optional($ballot->position)->name }}</strong>, Win ({{ $ballot->vote_limit }}) Only
                                        </h3>
                                        <div class="eVote-table table-responsive">
                                            <table class="table table-success align-middle">
                                                <thead>
                                                <tr>
                                                    <th>S/L</th>
                                                    <th>Candidate Name</th>
                                                    <th>Image</th>
                                                    <th class="text-center">Vote</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ballot->ballotItems as $key => $ballotItem)
                                                    <tr>
                                                        <td>{{ $key += 1 }}</td>
                                                        <td>{{ optional($ballotItem->candidate)->name }}</td>
                                                        <td>
                                                            <img
                                                                    src="{{ get_uploaded_file_url(optional($ballotItem->candidate)->icon) }}"
                                                                    alt="img" class="img-fluid candidate-img">
                                                        </td>
                                                        <td class="text-center total-vote">
                                                            {{ optional($ballotItem->candidate)->offline_vote_count ?? 0 }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
