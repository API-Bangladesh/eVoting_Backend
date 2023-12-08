@extends('admin.layout.master')
@section('title', 'Create User')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create User
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user-list') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('store-user') }}" method="POST"
                          class="add-user-form p-4 is-drop-shadow bg-white rounded form">
                        @csrf
                        @method('POST')

                        @include('admin.user.form')

                        <div class="offset-lg-3">
                            <button type="submit" id="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
