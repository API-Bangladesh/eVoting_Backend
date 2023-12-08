@extends('admin.layout.master')
@section('title', 'Dashboard')

@section('content')
    <main id="dashboard" style="margin-bottom: 100px;">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">
                Dashboard
            </h3>
            <div class="row">
                <div class="col-xxl-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div
                                            class="all-pervading-widget bg-primary d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                        <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                            <i class="bi bi-people text-dark fs-2"></i>
                                        </div>
                                        <div class="widget-content flex-grow-1">
                                            <h4 class="text-light mb-0">
                                                {{ get_count_total_voters() }}
                                            </h4>
                                            <p class="text-light fw-normal mb-0">
                                                <small>Total Voters</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div
                                            class="all-pervading-widget bg-success d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                        <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                            <i class="bi bi-people text-dark fs-2"></i>
                                        </div>
                                        <div class="widget-content flex-grow-1">
                                            <h4 class="text-light mb-0">
                                                {{ get_count_total_casted_votes() }}
                                            </h4>
                                            <p class="text-light fw-normal mb-0">
                                                <small>Total Cast</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div
                                            class="all-pervading-widget bg-danger d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                        <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                            <i class="bi bi-people text-dark fs-2"></i>
                                        </div>
                                        <div class="widget-content flex-grow-1">
                                            <h4 class="text-light mb-0">
                                                {{ get_count_total_absent_voters() }}
                                            </h4>
                                            <p class="text-light fw-normal mb-0">
                                                <small>Total Absent</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(is_enable_online_voting_function())
                            <div class="col-md-12">
                                <h6 class="border text-dark rounded p-1 mb-3">
                                    <i class="bi bi-arrow-bar-right me-1"></i>
                                    Online Voting Result
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-primary d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_online_voters() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Online Voters</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-secondary d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person-check-fill text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_online_check_in() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Online CheckIn</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-success d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-app-indicator text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">{{ get_count_online_casted_votes() }}</h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Total Cast</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-danger d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-app-indicator text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">{{ get_count_online_absent_voters() }}</h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Total Absent</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(is_enable_offline_voting_function())
                            <div class="col-md-12">
                                <h6 class="border text-dark rounded p-1 mb-3">
                                    <i class="bi bi-arrow-bar-right me-1"></i>
                                    Offline Voting Result
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-primary d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person-badge text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_offline_voters() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Offline Voters</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-secondary d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person-lines-fill text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_offline_check_in() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Offline CheckIn</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-success d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person-lines-fill text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_offline_casted_votes() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Total Voted Ballots</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div
                                                class="all-pervading-widget bg-danger d-flex align-items-center gap-3 rounded is-drop-shadow p-4 mb-4">
                                            <div class="widget-icon bg-white p-2 rounded flex-shrink-0">
                                                <i class="bi bi-person-lines-fill text-dark fs-2"></i>
                                            </div>
                                            <div class="widget-content flex-grow-1">
                                                <h4 class="text-light mb-0">
                                                    {{ get_count_offline_absent_voters() }}
                                                </h4>
                                                <p class="text-light fw-normal mb-0">
                                                    <small>Total Invalid Ballots/Absent Voters</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
