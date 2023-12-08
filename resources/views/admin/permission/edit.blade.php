@extends('admin.layout.master')
@section('title', 'Edit Permission')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Update Permission
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('permission-list') }}">Permissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('update-permission', $permission->id) }}" method="POST"
                          enctype="multipart/form-data" class="p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')

                        <div class="row align-items-center form-group mb-3">
                            <label for="name" class="col-lg-3 text-lg-end col-form-label">
                                Permission Name: <span class="text-danger">*</span>
                            </label>
                            <div class="col flex-grow-1">
                                <input type="text" required class="form-control rounded-pill ps-4" name="name" id="name"
                                       value="{{ old('name', $permission->name) }}"
                                       placeholder="Enter Permission Name"/>
                                @error('name')
                                <div class="error text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center form-group mb-3">
                            <div class="offset-lg-3 col flex-grow-1">
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
    <!-- dashboard -->
@endsection
