@extends('admin.layout.master')
@section('title', 'Online Voting Result')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Online Voting Result</h3>
            <div class="p-4 py-5 is-drop-shadow bg-white rounded">
                <div class="row justify-content-center pt-3">
                    <div class="col-xxl-3 col-xl-4 col-sm-6 mb-4 mb-sm-0">
                        <div class="p-2 py-4 p-xl-4 bg-primary d-flex align-items-center bg-gradient rounded h-100">
                            <p class="mb-0 fs-5 text-light">
                                Total Online Vote: {{ $totalOnlineVoters ?? 0 }}
                            </p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 mb-4 mb-sm-0">
                        <div class="p-2 py-4 p-xl-4 bg-success d-flex align-items-center bg-gradient rounded h-100">
                            <p class="mb-0 fs-5 text-light">
                                Accepted Vote: {{ $totalOnlineVotes ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
                <div id="result" class="result bg-white p-3 p-md-4" data-api-url="{{ env('APP_URL') }}">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" id="btn-scanning-result"
                                class="btn btn-info text-light px-4 rounded-pill">
                            <i class="bi bi-align-start"></i>
                            <span class="text">Start</span>
                        </button>
                        <p class="current-ballot mb-0 fs-4"></p>
                    </div>
                    <div id="result-scanning" class="row gx-5 mt-5">
                        <div class="col-xl-6">
                            <div id="ballots-widget" class="ballots-body">
                                <h4 class="fs-3 fw-normal mb-4">Ballots</h4>
                                <div class="is-loading d-none spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div id="candidates-result" class="ballots-body mt-5">
                                <div class="pt-5">
                                    <div class="pt-1">
                                        <h4 class="fs-3 fw-normal mb-4">Vote Count</h4>
                                        <div class="is-loading d-none spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="enter-full-screen text-lg-end">
                        <button id="btn-enterFullScreen" class="btn btn-primary">Full Screen View</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/evote-result-scanning.js') }}"></script>
@endsection
