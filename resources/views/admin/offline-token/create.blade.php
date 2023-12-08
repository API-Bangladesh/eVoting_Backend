@extends('admin.layout.master')
@section('title', 'Create Offline Token')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Create Offline Token</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        <span class="d-inline-block me-3">
                            Total Voters:
                            <strong class="text-cyan">
                                {{ $offlineVoters->total() }}
                            </strong>
                        </span>
                    </div>

                    @can('search offline-tokens')
                        <form action="{{ route('search-offline-token') }}" method="GET"
                              class="col-xl-4 form-group d-flex align-items-center gap-2 mb-3 mb-sm-0">
                            @csrf

                            <label for="keywords" class="flex-shrink-0">Search: </label>
                            <input type="search" name="keywords" value="{{ request()->input('keywords') }}"
                                   class="form-control rounded-pill flex-grow-1"
                                   id="keywords" placeholder="Search voter info"
                                   title="Search by Member ID, Name, Email or Phone"/>
                        </form>
                    @endcan
                </div>

                @include('common.alert-message')

                @unlessrole(\App\Models\Role::TYPE_OFFICER)
                <p class="bg-warning rounded text-center p-2 mb-4">
                    Note: Only officers can create the token.
                </p>
                @endunlessrole

                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Member ID</th>
                            <th>Voter Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offlineVoters as $key => $offlineVoter)
                            <tr>
                                <td>{{ $key + $offlineVoters->firstItem() }}</td>
                                <td>{{ $offlineVoter->member_id }}</td>
                                <td>{{ $offlineVoter->name }}</td>
                                <td>{{ $offlineVoter->email_address }}</td>
                                <td>{{ $offlineVoter->contact_number }}</td>
                                <td>
                                    <a href="{{ get_uploaded_file_url($offlineVoter->image) }}" target="_blank">
                                        <img src="{{ get_uploaded_file_url($offlineVoter->image) }}"
                                             alt="{{ $offlineVoter->name }}" width="500" height="600">
                                    </a>
                                </td>
                                <td>
                                    @role(\App\Models\Role::TYPE_OFFICER)
                                    <button type="button"
                                            class="btn btn-sm btn-primary showCreateOfflineTokenModal"
                                            data-member_id="{{ $offlineVoter->member_id }}">
                                        Create Token
                                    </button>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $offlineVoters->links() }}

            </div>
        </div>
    </main>

    <script type="text/javascript">
        $('.showCreateOfflineTokenModal').on('click', function (e) {
            e.preventDefault();

            let el = $(this);
            let memberId = el.data('member_id');
            let modal = $('#modalCreateOfflineToken');

            modal.find('input[name="member_id"]').val(memberId);
            modal.modal('show');
        });

        /**
         * Handle Submit
         */
        function handleSubmit() {
            setInterval(function () {
                if (getCookie('download')) {
                    let modal = $('#modalCreateOfflineToken');
                    modal.modal('hide');

                    setCookie('download', '', new Date(), '/');

                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }, 1000)
        }

    </script>

    {{-- create token modal --}}
    <div class="modal fade" id="modalCreateOfflineToken">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Token</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-offline-token') }}" onsubmit="handleSubmit()" method="post">
                        <input type="hidden" name="member_id" value="">
                        @csrf
                        @method('POST')

                        <div class="content-body text-sm-end p-3 py-4">
                            <div class="row align-items-center form-group">
                                <label for="card_no" class="col-sm-3 form-label">Optional Info:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="card_no" value="{{ old('card_no') }}" id="card_no"
                                           class="form-control rounded-pill mb-3"
                                           placeholder="Others info."/>
                                </div>
                            </div>
                            <div class="row align-items-center form-group">
                                <label for="phone" class="col-sm-3 form-label">
                                    Phone No.: <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                           class="form-control rounded-pill mb-3"
                                           placeholder="Phone No." required="required"/>
                                </div>
                            </div>
                            <div class="row align-items-center form-group">
                                <label for="secret_code" class="col-sm-3 form-label">
                                    Secret Code: <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password" name="secret_code" id="secret_code"
                                           class="form-control rounded-pill mb-3" placeholder="Secret Code"
                                           required="required" autocomplete="new-password"/>
                                </div>
                            </div>
                            <div class="form-group text-start row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
