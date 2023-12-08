@extends('admin.layout.master')
@section('title', 'Offline Result Entry')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Offline Result Entry</h3>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form
                            action="{{ (setting()->get('disable_offline_voting_result_upload') != 1) ? route('update-offline-voting-result') : '#' }}"
                            method="post"
                            class="add-user-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="d-flex align-items-center justify-content-between border rounded px-3 py-2">
                                <div class="row align-items-center flex-column form-group mb-3">
                                    <label for="total_valid_ballots" class="col-form-label">
                                        Total Valid Ballots
                                    </label>
                                    <div class="col-lg-6 col-xl-4 d-flex align-items-center">
                                        <h3 class="text-primary m-0">
                                            {{ get_count_offline_voters() ?? 0 }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="row align-items-center flex-column form-group mb-3">
                                    <label for="total_valid_ballots" class="col-form-label">
                                        Total Voted Ballots
                                    </label>
                                    <div class="col-lg-6 col-xl-4 d-flex align-items-center">
                                        <h3 class="text-success m-0">
                                            {{ get_count_offline_casted_votes() ?? 0 }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="row align-items-center flex-column form-group mb-3">
                                    <label for="total_invalid_ballots" class="col-form-label">
                                        Total Invalid Ballots / Absent Voters
                                    </label>
                                    <div class="col-lg-6 col-xl-4 d-flex align-items-center">
                                        <h3 class="text-danger m-0">
                                            {{ get_count_offline_absent_voters() ?? 0 }}
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="candidates-by-position mt-4">
                                @foreach($ballots as $key => $ballot)
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <label for="#"
                                                   class="col-form-label col-md-3 text-primary fs-5 d-block text-lg-start">
                                                Add Position <i class="bi bi-arrow-right text-danger"></i>
                                            </label>
                                            <label for="#"
                                                   class="col-form-label col-md-9 text-primary fs-5 d-block text-lg-start">
                                                {{ optional($ballot->position)->name }}
                                            </label>
                                        </div>
                                        @foreach($ballot->ballotItems as $key => $ballotItem)
                                            <div class="form-group mb-1">
                                                <div class="row align-items-center form-group">
                                                    <label
                                                            for="{{ \Illuminate\Support\Str::kebab(optional($ballotItem->candidate)->name) }}"
                                                            class="col-lg-3 col-form-label">
                                                        {{ optional($ballotItem->candidate)->name }}
                                                    </label>
                                                    <div class="col-lg-6 col-xl-4">
                                                        <input type="number"
                                                               name="candidate_ids[{{ optional($ballotItem->candidate)->id }}]"
                                                               value="{{ optional($ballotItem->candidate)->offline_vote_count }}"
                                                               class="form-control rounded-pill ps-4" id="#"
                                                               placeholder="Vote Entry"/>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if(setting()->get('disable_offline_voting_result_upload') != 1)
                            <div class="offset-lg-3">
                                <!--
                                <button type="submit" name="save" value="Save"
                                        class="btn btn-primary text-light px-4 rounded-pill">
                                    Save
                                </button>
                                -->
                                <button type="submit" name="save_lock" value="Save & Lock" id="btn-save-locked"
                                        class="btn btn-warning text-light px-4 rounded-pill">
                                    Save & Lock
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            $('#btn-save-locked').on('click', function (e) {
                let confirm = prompt("Please type 'CONFIRM' to save & locked. \nOnce saved, data can not be inserted or modified.");
                if (confirm != null) {
                    if (confirm !== 'CONFIRM') {
                        e.preventDefault();
                        e.stopPropagation();
                        return
                    }
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    return
                }
            });
        });
    </script>
@endsection
