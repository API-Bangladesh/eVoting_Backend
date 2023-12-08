@extends('admin.layout.master')
@section('title', 'Print Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Print Setting</h3>

            @include('common.alert-message')

            <div class="row">

                <div class="col-md-12">

                    <form action="{{ route('update-print-setting') }}" method="post"
                          class="settings p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')
                        <p class="text-warning">
                            This setting is for printing ballot paper with attached Barcode/QR code
                            <a class="w3-btn" href="{{ route('qr-code-list') }}">
                                <span class="w3-hide-small">see here</span>
                            </a>
                        </p>

                        <div class="row align-items-start form-group mb-3">
                            <label for="ballot" class="col-lg-3 text-lg-end col-form-label">Print With:</label>
                            <div class="col flex-grow-1">
                                <div class="form-group mt-2">
                                    <div class="form-check border-bottom pb-2 mb-2">
                                        <input class="form-check-input" name="ballot_print" type="checkbox" value="1"
                                               id="ballot" @if($setting->ballot_print) checked @endif />
                                        <label class="form-check-label" for="ballot">
                                            Ballot Info <a href="{{ asset('assets/img/ballot-example.png') }}"
                                                           class="text-dark ms-2"
                                                           target="_blank">
                                                <i class="bi bi-info-circle"></i>
                                            </a>
                                        </label>
                                        <small class="text-muted d-block" style="font-size: 12px;">
                                            Print ballots with attached Qr-Code.
                                        </small>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   @if($setting->print_code === 'barcode') checked @endif type="radio"
                                                   name="print_code" id="barcode" value="barcode"/>
                                            <label class="form-check-label" for="barcode">Bar Code</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="print_code" id="qrcode"
                                                   @if($setting->print_code === 'qrcode') checked
                                                   @endif value="qrcode"/>
                                            <label class="form-check-label" for="qrcode">QR Code</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start form-group mb-3">
                            <label for="#" class="col-lg-3 text-lg-end col-form-label">
                                Bar/QR Code Position: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <select class="form-control rounded-pill ps-4 form-select mt-2" name="position" id="#">
                                    <option value="top-left" @if($setting->position === 'top-left') selected @endif>Top
                                        Left
                                    </option>
                                    <option value="top-right" @if($setting->position === 'top-right') selected @endif>
                                        Top Right
                                    </option>
                                    <option value="bottom-left"
                                            @if($setting->position === 'bottom-left') selected @endif>Bottom Left
                                    </option>
                                    <option value="bottom-right"
                                            @if($setting->position === 'bottom-right') selected @endif>Bottom Right
                                    </option>
                                </select>
                                @error('position')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center form-group mb-3">
                            <label for="orientation" class="col-lg-3 text-lg-end col-form-label">
                                Orientation: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <select class="form-control rounded-pill ps-4 form-select" name="orientation"
                                        id="orientation">
                                    <option value="portrait" @if($setting->orientation === 'portrait') selected @endif>
                                        Portrait
                                    </option>
                                    <option value="landscape"
                                            @if($setting->orientation === 'landscape') selected @endif>
                                        Landscape
                                    </option>
                                </select>
                                @error('orientation')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center form-group mb-3">
                            <label for="paper-size" class="col-lg-3 text-lg-end col-form-label">
                                Paper Size: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <select class="form-control rounded-pill ps-4 form-select" name="paper_size"
                                        id="paper-size">
                                    <option value="a4" @if($setting->paper_size === 'a4') selected @endif>A4</option>
                                    <option value="letter" @if($setting->paper_size === 'letter') selected @endif>
                                        Letter
                                    </option>
                                    <option value="custom" @if($setting->paper_size === 'custom') selected @endif>
                                        Custom
                                    </option>
                                </select>
                                @error('paper_size')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="custom-paper-size mt-1 offset-lg-3 col-lg-9" style="display: none">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <input type="number" class="form-control rounded-pill ps-4" name="width"
                                               placeholder="Width in Inches" title="Width in Inches"
                                               value="{{ old('width', $setting->width) }}"/>
                                        @error('width')
                                        <div class="error text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control rounded-pill ps-4" name="height"
                                               placeholder="Height in Inches" title="Height in Inches"
                                               value="{{ old('height', $setting->height) }}"/>
                                        @error('height')
                                        <div class="error text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center form-group mb-3">
                            <label for="max_limit" class="col-lg-3 text-lg-end col-form-label"
                                   title="Maximum rows limitation to print">
                                Max Limit: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <input type="number" class="form-control rounded-pill ps-4" name="max_limit"
                                       placeholder="Max Limit" id="max_limit" max="150"
                                       value="{{ old('max_limit', $setting->max_limit) }}"/>
                                @error('max_limit')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="update offset-lg-3 col-lg-9 mt-4">
                            <button type="submit" class="btn btn-info text-light rounded-pill px-4">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(function () {
            const customPaperSize = (value) => {
                if (value === 'custom') {
                    $('.custom-paper-size').slideDown();
                } else {
                    $('.custom-paper-size').slideUp();
                }
            }
            customPaperSize($('#paper-size').val());
            $('#paper-size').length &&
            $('#paper-size').on('change', function (e) {
                customPaperSize($(this).val());
            });
        });
    </script>
@endsection
