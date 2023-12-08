@extends('admin.layout.master')
@section('title', 'Create Candidate')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create Candidate
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('candidate-list') }}">Candidates</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">

                    @include('common.alert-message')

                    <form action="{{route('store-candidate')}}" method="post"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="name" class="col-lg-3 col-form-label">
                                    Name: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="text" class="form-control rounded-pill ps-4" id="name" name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Candidate Name"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('name')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    Icon: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <label
                                            class="upload-file position-relative d-block w-100 text-start p-2 d-block border rounded-pill">
                                        <span class="title text-muted ps-1 fw-normal mb-0">
                                            <var><small>Browse Image</small></var>
                                        </span>
                                        <input type="file" name="icon" class="form-control candidate-img-file d-none"
                                               accept="image/jpeg, image/jpg, image/png"/>
                                        <span
                                                class="d-inline-block bg-primary position-absolute end-0 top-0 rounded-pill p-1 px-4 mt-1 me-1">
                                            <i class="bi bi-upload text-light"></i>
                                        </span>
                                    </label>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('icon')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="offset-lg-3">
                                <button type="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
