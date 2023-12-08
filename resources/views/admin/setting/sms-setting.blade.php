@extends('admin.layout.master')
@section('title', 'Sms Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">Sms Setting </h3>
                <div
                        class="create-new-field d-flex align-items-center justify-content-end gap-2 mb-4 pb-3">
                    <button type="button" class="btn btn-add-field btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#sendTestSmsModal" title="Testing Sms Service">
                        <i class="bi bi-plus-lg me-1"></i>
                        Send Test Sms
                    </button>
                </div>

                {{-- Test Sms Send Modal --}}
                <div class="modal fade" id="sendTestSmsModal" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content modalmail">
                            <div class="modal-header">
                                <h5 class="modal-title">Send Test Sms</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <form action="{{ url('/send-test-sms') }}" method="post" class="modal-body px-5">
                                @csrf
                                @method('POST')

                                <div class="form-group mb-3">
                                    <label for="phone" class="mb-1">
                                        Phone: <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control" name="phone" id="phone"
                                           placeholder="Enter Phone"
                                           value="{{ old('phone') }}"
                                           required="required">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sms" class="mb-1">
                                        Message: <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="sms" cols="4" rows="4" class="form-control" maxlength="160"
                                              required="required"
                                              placeholder="Enter Message">{{ old('sms') }}</textarea>
                                    <small class="d-block text-muted">Maximum 160 characters limit.</small>
                                </div>
                                <div class="form-group d-flex justify-content-end mb-2">
                                    <input type="reset" class="btn btn-secondary me-2" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Send">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @include('common.alert-message')

                    <form action="{{ route('update-sms-setting') }}" method="post"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data"
                          style="margin-bottom: 150px;">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="api_token_sslwireless" class="col-lg-3 col-form-label">
                                            API Token: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4"
                                                   id="api_token_sslwireless"
                                                   name="api_token_sslwireless"
                                                   value="{{ old('api_token_sslwireless', $setting->api_token_sslwireless) }}"
                                                   placeholder="Enter API Token"/>
                                            @error('api_token_sslwireless')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="domain_sslwireless" class="col-lg-3 col-form-label">
                                            Domain URL: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="url" class="form-control rounded-pill ps-4"
                                                   id="domain_sslwireless"
                                                   name="domain_sslwireless"
                                                   value="{{ old('domain_sslwireless', $setting->domain_sslwireless) }}"
                                                   placeholder="Enter Gateway Domain"/>
                                            @error('api_token_sslwireless')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="sid_sslwireless" class="col-lg-3 col-form-label">
                                            SID: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4"
                                                   id="sid_sslwireless"
                                                   name="sid_sslwireless"
                                                   value="{{ old('sid_sslwireless', $setting->sid_sslwireless) }}"
                                                   placeholder="Enter SID Key"/>
                                            @error('sid_sslwireless')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-3">
                                <button type="submit" class="btn btn-info text-light px-4 rounded-pill">
                                    Update
                                </button>
                            </div>
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
