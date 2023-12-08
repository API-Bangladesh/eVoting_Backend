@extends('admin.layout.master')
@section('title', 'Email Setting')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">Test Devices & Services </h3>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('common/test-print-rongta') }}" class="btn btn-primary d-block">
                        <i class="bi bi-printer me-2"></i> Test Print (RONGTA)
                    </a>
                </div>
                <div class="col-md-9 text-end">
                    <input type="text" class="form-control form-control-lg" placeholder="Pointer Here..">
                    <small class="bg-warning rounded text-white px-1">
                       <i class="bi bi-arrow-right me-1"></i> To check barcode scanner, please put your cursor pointer into the input & scan any code.
                    </small>
                </div>
            </div>
            <br>
            @include('admin.common._test-email-form')
            <br>
            @include('admin.common._test-sms-form')

            <br>
            <br>
            <br>

        </div>
    </main>
@endsection
