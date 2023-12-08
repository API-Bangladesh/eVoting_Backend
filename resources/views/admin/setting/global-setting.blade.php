@extends('admin.layout.master')
@section('title', 'Global Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Global Setting </h3>
            <div class="row">
                <div class="col-md-12">

                    @include('common.alert-message')

                    <form action="{{ route('update-global-setting') }}" method="post"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data">
                        <input type="hidden" name="old_icon" value="{{ $setting->icon }}">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    Organization Name: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill ps-4" id="#"
                                           value="{{ old('organization_name', $setting->organization_name) }}"
                                           name="organization_name" placeholder="Organization Name"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('organization_name')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="upload-file" class="col-lg-3 col-form-label">
                                    Organization Logo:
                                </label>
                                <div class="col flex-grow-1">
                                    <label style="height: 42px"
                                           class="upload-file position-relative d-block w-100 text-start p-2 d-block border rounded-pill">
                                        <span class="title text-muted ps-1 fw-normal mb-0">
                                            <var>
                                                <small id="uploadedFileName">
                                                    {{ ($setting->icon) ? old('icon', $setting->icon) : 'Browse Logo' }}
                                                </small>
                                            </var>
                                        </span>
                                        <input id="upload-file" type="file" name="icon"
                                               value="{{ old('icon', $setting->icon) }}"
                                               class="form-control candidate-img-file d-none"
                                               accept="image/jpeg, image/jpg, image/png"/>
                                        <span
                                                class="d-inline-block bg-primary position-absolute end-0 top-0 rounded-pill p-1 px-4 mt-1 me-1">
                                            <i class="bi bi-upload text-light"></i>
                                        </span>
                                    </label>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('icon')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center text-lg-start form-group mb-3">
                                <div class="offset-lg-3 col flex-grow-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="text-logo" type="radio" name="logo_type"
                                               value="text-logo"
                                               @if($setting->logo_type == 'text-logo') checked @endif >
                                        <label class="form-check-label" for="text-logo">Set logo as text</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="img-logo" type="radio" name="logo_type"
                                               value="img-logo" @if($setting->logo_type == 'img-logo') checked @endif>
                                        <label class="form-check-label" for="img-logo">Set logo as image</label>
                                    </div>
                                </div>
                            </div>
                            @if(is_enable_online_voting_function())
                                <div class="row align-items-center form-group mb-3">
                                    <label for="online_application_form_url" class="col-lg-3 col-form-label">
                                        Online Application Form Link: <span class="text-danger">*</span>
                                    </label>
                                    <div class="col flex-grow-1">
                                        <input type="url" class="form-control rounded-pill ps-4"
                                               id="online_application_form_url"
                                               value="{{ old('online_application_form_url', $setting->online_application_form_url) }}"
                                               name="online_application_form_url"
                                               placeholder="Write Application Form URL"/>
                                    </div>
                                    <div class="text-start offset-lg-3 col-12 col-lg-9">
                                        @error('online_application_form_url')
                                        <p class="text-danger ">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center form-group mb-3">
                                    <label for="online_voting_url" class="col-lg-3 col-form-label">
                                        Online Voting Link: <span class="text-danger">*</span>
                                    </label>
                                    <div class="col flex-grow-1">
                                        <input type="url" class="form-control rounded-pill ps-4" id="online_voting_url"
                                               value="{{ old('online_voting_url', $setting->online_voting_url) }}"
                                               name="online_voting_url" placeholder="Write Online Voting Link"/>
                                    </div>
                                    <div class="text-start offset-lg-3 col-12 col-lg-9">
                                        @error('online_voting_url')
                                        <p class="text-danger ">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-info text-light px-4 rounded-pill">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        (function () {
            function checkMailMailer(value) {
                if (value === 'ses') {
                    $('.amazon-ses-dropdown').slideDown();
                    $('.amazon-ses-dropdown input.form-control').each(function () {
                        $(this).attr('required', 'true');
                    });
                } else {
                    $('.amazon-ses-dropdown').slideUp();
                    $('.amazon-ses-dropdown input.form-control').each(function () {
                        $(this).removeAttr('required');
                    });
                }
            }

            checkMailMailer($('#select-mailer-type').val());
            $('#select-mailer-type').change(function () {
                checkMailMailer($(this).val());
            });
        })();
    </script>
@endsection
