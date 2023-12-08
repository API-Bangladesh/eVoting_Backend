@extends('admin.layout.master')
@section('title', 'Create Email Template')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create Email Template
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('email-template-list') }}">Email Templates</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 mb-5">

                    @include('common.alert-message')

                    <form action="{{ route('store-email-template') }}" method="POST"
                          class="create-email-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('POST')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    Select Category: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <select id="createCategory_id" class="form-select form-control rounded-pill"
                                            aria-label="Default select example" name="category_id">
                                        <option value="" selected>__SELECT__</option>
                                        @foreach(get_email_template_categories() as $emailTemplateCategory)
                                            <option @if(old('category_id') == $emailTemplateCategory['id']) selected
                                                    @endif value="{{ $emailTemplateCategory['id'] }}">
                                                {{ $emailTemplateCategory['text'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div id="receiver_type" style="display: none">
                                <div class="row align-items-center form-group mb-3">
                                    <label class="col-lg-3 col-form-label">
                                        Receiver Type: <span class="text-danger">*</span>
                                    </label>
                                    <div class="col flex-grow-1 d-flex gap-3">
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id" class="form-check-input"
                                                   id="option1"
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_VOTERS }}"> All
                                            <label for="option1" class="form-check-label">
                                                Voters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id" class="form-check-input"
                                                   id="option2"
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_ONLINE_VOTERS }}">
                                            <label for="option2" class="form-check-label">
                                                All Online Voters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="receiver_type_id" class="form-check-input"
                                                   id="option3"
                                                   value="{{ \App\Models\EmailTemplate::RECEIVER_ALL_OFFLINE_VOTERS }}">
                                            <label for="option3" class="form-check-label">
                                                All Offline Voters
                                            </label>
                                        </div>
                                    </div>
                                    @error('receiver_type_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <script>
                                $(function () {
                                    if ($('#createCategory_id').length) {
                                        function initSlide(value) {
                                            value === '5' ? $('#receiver_type').slideDown() : $('#receiver_type').slideUp()
                                        }

                                        initSlide($('#createCategory_id').val());
                                        $('#createCategory_id').on('change', function () {
                                            initSlide($(this).val());
                                        })
                                    }
                                })
                            </script>
                            <div class="row align-items-center form-group mb-3">
                                <label for="subject" class="col-lg-3 col-form-label">
                                    Email Subject: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill" placeholder="Subject"
                                           name="subject" value="{{ old('subject') }}"
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
                                              placeholder="Write email body"
                                              name="body" id="body" cols="30" rows="5">{{ old('body') }}</textarea>
                                </div>
                                @error('body')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row align-items-start form-group mb-3">
                                <label for="sms" class="col-lg-3 col-form-label">SMS Body:</label>
                                <div class="col flex-grow-1">
									<textarea class="form-control rounded" placeholder="Write sms body"
                                              name="sms" id="sms" cols="30" rows="4"
                                              maxlength="160">{{ old('sms') }}</textarea>
                                </div>
                                @error('sms')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
