@extends('admin.layout.master')
@section('title', 'Email Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">Email Setting </h3>
                <div
                        class="create-new-field d-flex align-items-center justify-content-end gap-2 mb-4 pb-3">
                    <button type="button" class="btn btn-add-field btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#sendTestEmailModal" title="Test Email Service">
                        <i class="bi bi-plus-lg me-1"></i>
                        Send Test Email
                    </button>
                </div>

                {{-- Test Email Send Modal --}}
                <div class="modal fade" id="sendTestEmailModal" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content modalmail">
                            <div class="modal-header">
                                <h5 class="modal-title">Send Test Email</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <form action="{{ url('/send-test-email') }}" method="post" class="modal-body px-5">
                                @csrf
                                @method('POST')

                                <div class="form-group mb-3">
                                    <label for="email" class="mb-1">
                                        Email: <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="phone"
                                           placeholder="Email Address"
                                           value="{{ old('email') }}"
                                           required="required">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="subject" class="mb-1">
                                        Subject: <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="subject" id="subject"
                                           value="{{ old('subject') }}"
                                           placeholder="Email Subject" required="required">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="message" class="mb-1">
                                        Body: <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" cols="4" rows="4" class="form-control" id="message"
                                              required="required"
                                              placeholder="Email Body">{{ old('message') }}</textarea>
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

                    <form action="{{ route('update-email-setting') }}" method="post"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="select-mailer-type" class="col-lg-3 col-form-label">
                                            Select Mailer Type: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <select id="select-mailer-type"
                                                    class="form-select form-control rounded-pill ps-4"
                                                    name="mail_mailer" aria-label="Default select example">
                                                <option selected disabled>Select mailer type</option>
                                                <option @if(old('mail_mailer', $setting->mail_mailer) == 'smtp') selected
                                                        @endif value="smtp">
                                                    SMTP
                                                </option>
                                                <option @if(old('mail_mailer', $setting->mail_mailer) == 'ses') selected
                                                        @endif value="ses">
                                                    Amazon SES
                                                </option>
                                            </select>
                                            @error('mail_mailer')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="amazon-ses-dropdown offset-lg-3 col-12 col-lg-9"
                                             style="display: none">
                                            <div class="row gx-2 mt-1">
                                                <div class="col-md-4">
                                                    <input type="text"
                                                           class="form-control form-control-sm rounded-pill ps-4"
                                                           id="aws_access_key"
                                                           value="{{ old('aws_access_key', $setting->aws_access_key) }}"
                                                           name="aws_access_key" placeholder="AWS Access Key"/>
                                                    @error('aws_access_key')
                                                    <div class="error text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                           class="form-control form-control-sm rounded-pill ps-4"
                                                           id="aws_secret_key" name="aws_secret_key"
                                                           value="{{ old('aws_secret_key', $setting->aws_secret_key) }}"
                                                           placeholder="AWS Secret Key"/>
                                                    @error('aws_secret_key')
                                                    <div class="error text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                           class="form-control form-control-sm rounded-pill ps-4"
                                                           id="aws_region" name="aws_region"
                                                           value="{{ old('aws_region', $setting->aws_region) }}"
                                                           placeholder="AWS Region"/>
                                                    @error('aws_region')
                                                    <div class="error text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_host" class="col-lg-3 col-form-label">
                                            Mail Host: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4" id="mail_host"
                                                   name="mail_host"
                                                   value="{{ old('mail_host', $setting->mail_host) }}"
                                                   placeholder=" Enter host name"/>
                                            @error('mail_host')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_port" class="col-lg-3 col-form-label">
                                            Mail Port: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="number" class="form-control rounded-pill ps-4" id="mail_port"
                                                   name="mail_port"
                                                   value="{{ old('mail_port', $setting->mail_port) }}"
                                                   placeholder=" Enter port"/>
                                            @error('mail_port')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="select-encryption-type" class="col-lg-3 col-form-label">
                                            Select Encryption Type: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <select id="select-encryption-type"
                                                    class="form-select form-control rounded-pill ps-4"
                                                    name="mail_encryption">
                                                <option selected disabled>Select encryption type</option>
                                                <option @if($setting->mail_encryption === 'tls') selected
                                                        @endif value="tls">TLS
                                                </option>
                                                <option @if($setting->mail_encryption === 'ssl') selected
                                                        @endif value="ssl">SSL
                                                </option>
                                            </select>
                                            @error('mail_encryption')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_username" class="col-lg-3 col-form-label">
                                            Mail Username: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4" id="mail_username"
                                                   value="{{ old('mail_username', $setting->mail_username) }}"
                                                   name="mail_username"
                                                   placeholder="Enter mail username"/>
                                            @error('mail_username')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_password" class="col-lg-3 col-form-label">
                                            Mail Password: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4" id="mail_password"
                                                   value="{{ old('mail_password', $setting->mail_password) }}"
                                                   name="mail_password"
                                                   placeholder="Enter mail password"/>
                                            @error('mail_password')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_from_address" class="col-lg-3 col-form-label">
                                            Mail From Address: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4"
                                                   id="mail_from_address"
                                                   value="{{ old('mail_from_address', $setting->mail_from_address) }}"
                                                   name="mail_from_address" placeholder="Enter mail from address"/>
                                            @error('mail_from_address')
                                            <div class="error text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="mail_from_name" class="col-lg-3 col-form-label">
                                            Mail From Name: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" class="form-control rounded-pill ps-4"
                                                   id="mail_from_name"
                                                   value="{{ old('mail_from_name', $setting->mail_from_name) }}"
                                                   name="mail_from_name"
                                                   placeholder="Enter mail from name"/>
                                            @error('mail_from_name')
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
                } else {
                    $('.amazon-ses-dropdown').slideUp();
                }
            }

            checkMailMailer($('#select-mailer-type').val());
            $('#select-mailer-type').change(function () {
                checkMailMailer($(this).val());
            });
        })();
    </script>
@endsection
