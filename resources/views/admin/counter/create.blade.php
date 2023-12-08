@extends('admin.layout.master')
@section('title', 'Create Token Counter')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create Token Counter
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('counter-list') }}">Token Counters</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('store-counter') }}" method="post"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="counter_number" class="col-lg-3 col-form-label">
                                    Counter Number: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill ps-4" id="counter_number"
                                           name="counter_number" value="{{ old('counter_number') }}"
                                           placeholder="Counter Number"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('counter_number')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="counter_name" class="col-lg-3 col-form-label">
                                    Name (If Any):  <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill ps-4" id="counter_name"
                                           name="counter_name" value="{{ old('counter_name') }}"
                                           placeholder="Counter Name"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('counter_name')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="counter_officer_id" class="col-lg-3 col-form-label">
                                    Counter Officer:  <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <select class="form-select form-control rounded-pill ps-4" name="counter_officer_id"
                                            id="counter_officer_id">
                                        <option disabled selected>Select Counter Officer</option>
                                        @foreach(get_counter_officer_list() as $counterOfficer)
                                            <option @if($counterOfficer->id == old('counter_officer_id')) selected
                                                    @endif value="{{ $counterOfficer->id }}">{{ $counterOfficer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('counter_officer_id')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
