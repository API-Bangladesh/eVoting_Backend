@extends('admin.layout.master')
@section('title', 'Create Ballot')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Create Ballot
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ballot-papers') }}">Ballots</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @include('common.alert-message')

                    <form id="create-candidate-form" action="{{ route('store-ballot') }}" method="post"
                          enctype="multipart/form-data"
                          class="p-4 is-drop-shadow bg-white rounded formdata">
                        @csrf
                        @method('POST')

                        <div id="create-candidate-under-position" class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    Position Name: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <select name="position_id" id="position_id" class="form-select rounded-pill ps-4">
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}">
                                                {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="vote_limit" class="col-lg-3 text-lg-end col-form-label">
                                    Vote Limit: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="number" class="form-control rounded-pill ps-4" name="vote_limit"
                                           id="vote_limit"
                                           placeholder="Enter Vote Limit"/>
                                    @error('vote_limit')
                                    <div class="error text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="candidate-number" class="col-lg-3 col-form-label">
                                    No. Of Candidates: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input id="candidate-number" type="number" required value="1"
                                           class="form-control rounded-pill ps-4"/>
                                </div>
                                <div class="col flex-grow-0">
                                    <button type="button" id="btn-candidate-add"
                                            class="btn btn-info text-light px-4 rounded-pill">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="candidates" class="mt-5 offset-lg-3 text-center">
                            <!-- Candidates will show here by js -->
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-save btn-primary text-light px-4 rounded-pill d-none">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
