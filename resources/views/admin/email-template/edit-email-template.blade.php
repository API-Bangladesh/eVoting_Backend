@extends('admin.layout.master')
@section('title', 'Edit Email Template')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Update Email Template
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('email-template-list') }}">Email Templates</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 mb-5">

                    @include('common.alert-message')

                    <form action="{{ route('update-email-template', $emailTemplate->id) }}" method="POST"
                          class="create-email-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="category_id" class="col-lg-3 col-form-label">
                                    Select Category:
                                </label>
                                <div class="col flex-grow-1">
                                    <select style="user-select: none; pointer-events:none;"
                                            class="form-control rounded-pill" aria-label="Default select example"
                                            readonly>
                                        <option>{{ get_email_category_name($emailTemplate->category_id) }}</option>
                                    </select>
                                </div>
                            </div>
                            @if ($emailTemplate->category_id == \App\Models\EmailTemplate::GENERAL)
                                <div class="row align-items-center form-group mb-3">
                                    <label class="col-lg-3 col-form-label">
                                        Receiver Type: <span class="text-danger">*</span>
                                    </label>
                                    <div class="col flex-grow-1 d-flex gap-3">
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id"
                                                   class="form-check-input countVotersAsReceiver" id="option1"
                                                   @if ($emailTemplate->receiver_type_id == \App\Models\EmailTemplate::RECEIVER_ALL_VOTERS) checked
                                                   @endif
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_VOTERS }}">
                                            <label for="option1" class="form-check-label">
                                                All Voters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id"
                                                   class="form-check-input countVotersAsReceiver" id="option2"
                                                   @if ($emailTemplate->receiver_type_id == \App\Models\EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS) checked
                                                   @endif
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS }}">
                                            <label for="option2" class="form-check-label">
                                                All Online Voters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id"
                                                   class="form-check-input countVotersAsReceiver" id="option3"
                                                   @if ($emailTemplate->receiver_type_id == \App\Models\EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS) checked
                                                   @endif
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS }}">
                                            <label for="option3" class="form-check-label">
                                                All Offline Voters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            Receivers: <span
                                                    class="btn btn-outline-primary rounded-1 btn-sm showReceiverCounter p-0 px-1">
                                                {{ $countReceivers }}
                                            </span>
                                        </div>
                                    </div>
                                    @error('receiver_type_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="row align-items-center form-group mb-3">
                                <label for="subject" class="col-lg-3 col-form-label">
                                    Email Subject: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill" placeholder="Subject"
                                           name="subject" value="{{ old('subject', $emailTemplate->subject) }}"
                                           id="subject"/>
                                </div>
                                @error('subject')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row align-items-start form-group mb-3">
                                <label for="body" class="col-lg-3 col-form-label">
                                    Email Body: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <textarea class="form-control rounded" id="mytextarea"
                                              placeholder="Write email body" name="body"
                                              id="body" cols="30"
                                              rows="5">{{ old('body', $emailTemplate->body) }}</textarea>
                                </div>
                                @error('body')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row align-items-start form-group mb-3">
                                <label for="sms" class="col-lg-3 col-form-label">SMS Body:</label>
                                <div class="col flex-grow-1">
                                    <textarea class="form-control rounded" placeholder="Write sms body" name="sms"
                                              id="sms" cols="30" maxlength="160"
                                              rows="4">{{ old('sms', $emailTemplate->sms) }}</textarea>
                                </div>
                                @error('sms')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{--<div class="form-group mt-3">
                                <div class="row align-items-center form-group mb-3">
                                    <label for="schedule_date" class="col-lg-3 col-form-label">
                                        Schedule date:
                                    </label>
                                    <div class="col flex-grow-1">
                                        <input type="text" class="form-control rounded-pill date-picker"
                                               name="schedule_date" id="schedule_date" placeholder="YYYY-MM-DD"
                                               value="{{ old('schedule_date', $emailTemplate->schedule_date) }}"
                                               autocomplete="off"/>
                                    </div>
                                    @error('schedule_date')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="row align-items-center form-group mb-3">
                                    <label for="schedule_time" class="col-lg-3 col-form-label">
                                        Schedule time:
                                    </label>
                                    <div class="col flex-grow-1">
                                        <input type="text" class="form-control rounded-pill time-picker"
                                               name="schedule_time" id="schedule_time" placeholder="00:00"
                                               value="{{ old('schedule_time', $emailTemplate->schedule_time) }}"/>
                                    </div>
                                    @error('schedule_time')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>--}}
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-info text-light px-4 rounded-pill">Update</button>
                            @can('send email-templates')
                                <a href="{{ route('send-email-by-category', $emailTemplate->id) }}"
                                   class="btn btn-primary px-4 rounded-pill">Send Email</a>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
