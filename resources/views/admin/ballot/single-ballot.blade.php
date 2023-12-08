@extends('admin.layout.master')
@section('title', 'View Ballot')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">View Ballots</h3>
            <div class="row">
                <div class="col-xxl-8 col-xl-10">
                    <div class="view-ballots p-4 is-drop-shadow bg-white rounded">
                        <div class="row align-items-center ballots-head mb-4">
                            <div class="col-lg-6">
                                <div class="club-details text-start d-inline-block">
                                    <h5 class="fs-5 fw-normal mb-1">{{ $settings->organization_name }}</h5>
                                    <p class="mb-0"><small>Executive Committee
                                            Election <?php echo setting()->get('election_year') ?></small></p>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end">
                                <img src="{{ get_uploaded_file_url($settings->icon) }}" alt="logo"
                                     class="img-fluid" style="max-height:80px ;"/>
                            </div>
                        </div>

                        <div class="ballots-body">
                            <div class="ballots-widget mb-4">
                                <h3 class="fs-6 fw-normal pb-2 b border-bottom mb-4">
                                    Select Any ({{ $ballot->vote_limit }}) For
                                    <strong>{{ optional($ballot->position)->name }}</strong>
                                </h3>
                                <div class="eVote-table table-responsive">
                                    <table class="table align-middle table-primary table-striped">
                                        <thead>
                                        <tr>
                                            <th>S/L</th>
                                            <th>President Candidate</th>
                                            <th>Image</th>
                                            <th class="text-center">Vote</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ballot->ballotItems as $key => $item)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                <td>{{ optional($item->candidate)->name }}</td>
                                                <td>
                                                    <img
                                                            src="{{ get_uploaded_file_url(optional($item->candidate)->icon) }}"
                                                            alt="logo" class="img-fluid"/>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-flex form-check-md">
                                                        <input class="form-check-input" readonly disabled
                                                               type="radio"/>
                                                    </div>
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
            </div>
        </div>
    </main>
@endsection
