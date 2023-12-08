@extends('admin.layout.master')
@section('title', 'Edit Counter Officer')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Update Counter Officer
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('counter-officer-list') }}">Counter Officers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('update-counter-officer', $counterOfficer->id) }}" method="post" class="add-user-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="name" class="col-lg-3 col-form-label">
                                    Officer Name: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill ps-4" id="name"
                                           name="name" value="{{ old('name', $counterOfficer->name) }}"
                                           placeholder="Write Name"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('name')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-start form-group mb-3">
                                <label for="info" class="col-lg-3 col-form-label">
                                    Other Info:
                                </label>
                                <div class="col flex-grow-1">
                                    <textarea class="form-control" placeholder="Write Information" name="info"
                                              id="info"
                                              rows="3">{{ old('info', $counterOfficer->info) }}</textarea>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('info')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
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
@endsection
