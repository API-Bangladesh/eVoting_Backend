@extends('admin.layout.master')
@section('title', 'Action Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Action Setting</h3>
            <div class="row">
                <div class="col-xxl-7 col-xl-10">
                    <div class="modal fade" id="archive" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="#" method="post" id="archive-modal-form" class="modal-body">
                                    @csrf
                                    <div class="content-body p-5 py-4">
                                        <h5 class="fs-6 fw-normal mb-4 lh-base">
                                            Please confirm to archive all voting result data for the year of [year_set]
                                        </h5>
                                        <div class="form-group">
                                            <input type="password" class="form-control rounded-pill mb-3"
                                                   id="admin_password" name="password" placeholder="Admin Password"/>
                                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1"> Disable all other user login except "Super Admin"</p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <input name="disable_common_users_login" value="1"
                                       class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                       @if($setting->disable_common_users_login) checked @endif role="switch"/>
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1">Disable import voters data</p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <input name="disable_voters_import" value="1"
                                       class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                       @if($setting->disable_voters_import) checked @endif role="switch"/>
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1">Disable imported voters deletion function</p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <input name="disable_voters_deletion" value="1"
                                       class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                       @if($setting->disable_voters_deletion) checked @endif role="switch"/>
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1"> Disable permanently voters deletion function </p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <input name="disable_permanently_voters_deletion" value="1"
                                       class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                       @if($setting->disable_permanently_voters_deletion) checked @endif role="switch"/>
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1">Display voting result in slideshow </p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <input name="display_voting_result" value="1"
                                       class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                       @if($setting->display_voting_result) checked @endif role="switch"/>
                            </div>
                        </li>
                        @if(is_enable_offline_voting_function())
                            <li class="list-group-item d-flex gap-2 align-items-center">
                                <p class="mb-0 flex-grow-1">Disable offline voting result upload function </p>
                                <div class="form-check form-switch-md form-switch flex-shrink-0">
                                    <input name="disable_offline_voting_result_upload" value="1"
                                           class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                           @if($setting->disable_offline_voting_result_upload) checked
                                           @endif role="switch"/>
                                </div>
                            </li>
                        @endif
                        @if(is_enable_online_voting_function())
                            <li class="list-group-item d-flex gap-2 align-items-center">
                                <p class="mb-0 flex-grow-1">Enable SMS Gateway service </p>
                                <div class="form-check form-switch-md form-switch flex-shrink-0">
                                    <input name="enable_sms_gateway_service" value="1"
                                           class="form-check-input handleUpdateSettingStatusOnChange" type="checkbox"
                                           @if($setting->enable_sms_gateway_service) checked
                                           @endif role="switch"/>
                                </div>
                            </li>
                        @endif
                        <li class="list-group-item d-flex flex-wrap gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1">Enabled voting functions for </p>
                            <div class="d-flex flex-wrap gap-4">
                                <div class="form-check form-switch-md form-switch d-inline-flex align-items-center gap-1 ">
                                    <input name="enable_voting_functions" value="1"
                                           class="form-check-input handleUpdateSettingValueOnChange" type="radio"
                                           @if($setting->enable_voting_functions == \App\Models\Setting::VFN_ONLINE) checked
                                           @endif role="switch"/>
                                    <label class="form-check-label mt-1" for="#">Online</label>
                                </div>
                                <div class="form-check form-switch-md form-switch d-inline-flex align-items-center gap-1">
                                    <input name="enable_voting_functions" value="2"
                                           class="form-check-input handleUpdateSettingValueOnChange" type="radio"
                                           @if($setting->enable_voting_functions == \App\Models\Setting::VFN_OFFLINE) checked
                                           @endif role="switch"/>
                                    <label class="form-check-label mt-1" for="#">Offline</label>
                                </div>
                                <div class="form-check form-switch-md form-switch d-inline-flex align-items-center gap-1">
                                    <input name="enable_voting_functions" value="3"
                                           class="form-check-input handleUpdateSettingValueOnChange" type="radio"
                                           @if($setting->enable_voting_functions == \App\Models\Setting::VFN_BOTH) checked
                                           @endif role="switch"/>
                                    <label class="form-check-label mt-1" for="#">Both</label>
                                </div>
                            </div>
                        </li>
                        {{--<li class="list-group-item d-flex gap-2 align-items-center">
                            <p class="mb-0 flex-grow-1">Archive data for the year 2021(Current Year)</p>
                            <div class="form-check form-switch-md form-switch flex-shrink-0">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#archive"
                                        class="btn btn-sm btn-secondary rounded-pill px-3">Archive
                                </button>
                            </div>
                        </li>--}}
                    </ul>
                    <script>
                        $('#archive-modal-form').on('submit', function (event) {
                            event.preventDefault();
                            let password = $("#admin_password").val();
                            $.ajax({
                                url: "/archive",
                                type: "POST",
                                data: {
                                    password: password
                                },
                                success: function (response) {

                                    $('#archive').modal('hide');
                                    $("#admin_password").val('');
                                    let alert = `<div class="alert alert-success" role="alert"> ${response.message} </div> `;
                                    $('#archive').after(alert);
                                    setTimeout(() => {
                                        $('.alert').slideUp(function () {
                                            $(this).remove();
                                        });
                                    }, 1000);
                                },
                                error: function (error) {

                                    $('#archive').modal('hide');
                                    $("#admin_password").val('');
                                    let alert = `<div class="alert alert-danger" role="alert"> ${error.responseJSON.message} </div> `;
                                    $('#archive').after(alert);
                                    setTimeout(() => {
                                        $('.alert').slideUp(function () {
                                            $(this).remove();
                                        });
                                    }, 1000);

                                }
                            });
                        })
                    </script>
                </div>
            </div>
        </div>
    </main>
    <!-- dashboard -->

@endsection
