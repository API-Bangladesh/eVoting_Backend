@extends('admin.layout.master')
@section('title', 'Archive')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Archive Summary</h3>
            <div class="row">
                <div class="col-xxl-12">
                    <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                        <div class="d-flex align-items-center justify-content-xl-end mb-4">
                            <div class="export-data d-flex align-items-center gap-2">
                                <p class="mb-0">Download as :</p>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="http://192.168.0.5:8000/download-voters-pdf" type="button"
                                        class="btn btn-danger btn-sm">Pdf</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Date </small></th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Voters </small></th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Online Voters </small></th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Offline Voters </small> </th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Vote Cast Online </small> </th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Vote Cast Offline </small> </th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Vote Cast </small></th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Candidate </small> </th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Total Position </small> </th>
                                        <th style="min-width:80px" class="align-middle" scope="col"> <small> Vote By Candidate </small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archives as $key => $item)
                                        <tr>
                                            <td class="text-nowrap"> {{ $item->created_at }}</td>
                                            <td class="text-nowrap">{{ $item->total_voters }}</td>
                                            <td class="text-nowrap">{{ $item->online_voters }}</td>
                                            <td class="text-nowrap">{{ $item->offline_voters }}</td>
                                            <td class="text-nowrap">{{ $item->vote_cast_online }}</td>
                                            <td class="text-nowrap">{{ $item->vote_cast_offline }}</td>
                                            <td class="text-nowrap">{{ $item->total_vote_cast }}</td>
                                            <td class="text-nowrap">{{ $item->total_candidate }}</td>
                                            <td class="text-nowrap">{{ $item->total_position }}</td>
                                            <td class="text-nowrap">
                                                <kbd>
                                                    {{ $item->vote_by_candidate }}
                                                </kbd>
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
    <!-- dashboard -->

@endsection
