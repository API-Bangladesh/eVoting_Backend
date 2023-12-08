@extends('admin.layout.master')
@section('title', 'Create Role')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create Role
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role-list') }}">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('store-role') }}" method="POST" enctype="multipart/form-data"
                          class="p-4 is-drop-shadow bg-white rounded">
                        @csrf

                        <div class="row align-items-center form-group mb-3">
                            <label for="name" class="col-lg-3 text-lg-end col-form-label">
                                Role Name: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <input type="text" class="form-control rounded-pill ps-4" name="name" id="name"
                                       value="{{ old('name') }}" placeholder="Enter Role Name"/>
                                @error('name')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center form-group mb-3">
                            <div class="offset-lg-3 col flex-grow-1">
                                <button type="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
