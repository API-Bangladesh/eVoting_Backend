@extends('admin.layout.master')
@section('title', 'Edit Ballot')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Update Ballot
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ballot-papers') }}">Ballots</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="create-candidate-form" action="{{ route('update-ballot', $ballot->id) }}" method="post"
                          enctype="multipart/form-data"
                          class="p-4 is-drop-shadow bg-white rounded formdata">
                        @csrf
                        @method('PUT')

                        <div id="create-candidate-under-position" class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    Position:
                                </label>
                                <div class="col flex-grow-0 font-weight-bold">
                                    {{ optional($ballot->position)->name }}
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="vote_limit" class="col-lg-3 text-lg-end col-form-label">
                                    Vote Limit: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="number" required class="form-control rounded-pill ps-4"
                                           name="vote_limit"
                                           id="vote_limit" value="{{ old('vote_limit', $ballot->vote_limit) }}"
                                           placeholder="Enter Vote Limit"/>
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="#" class="col-lg-3 col-form-label">
                                    No. Of Candidates: <span class="text-danger">*</span>
                                </label>
                                <div class="col flex-grow-1">
                                    <input id="candidate-number" type="number" required value="1"
                                           class="form-control rounded-pill ps-4" id="#"/>
                                </div>
                                <div class="col flex-grow-0">
                                    <button type="button" id="btn-candidate-add"
                                            class="btn btn-info text-light px-4 rounded-pill">Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="candidates" class="mt-5 offset-lg-3 text-center">
                            <!-- candidates will show here by js -->
                            @foreach($ballot->ballotItems as $key => $ballotItem)
                                <div class="candidate-widget pb-1 border-bottom mb-3">
                                    <div class="row gx-1">
                                        <div class="col-lg-3">
                                            <div class="widget-box border p-3">
                                                <p class="mb-0 lh-base candidate-name">
                                                    <strong class="candidate-text">
                                                        {{ optional($ballotItem->candidate)->name }}
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget-box border p-3">
                                                <img
                                                        src="{{ get_uploaded_file_url(optional($ballotItem->candidate)->icon) }}"
                                                        alt="img" name="icon" class="img-fluid candidate-img">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="widget-box border-start border-top border-bottom p-3">
                                                <select name="candidates[{{ $key }}][id]"
                                                        class="form-select rounded-pill candidate-name-control ps-4">
                                                    <option selected="" value=""> Select Candidate Name</option>
                                                    @foreach($candidates as $candidate)
                                                        <option
                                                                @if($candidate->id == optional($ballotItem->candidate)->id) selected
                                                                @endif value="{{ $candidate->id }}"
                                                                data-icon="{{ get_uploaded_file_url($candidate->icon) }}">
                                                            {{ $candidate->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <a href="{{ route('delete-ballot-item', $ballotItem->id) }}"
                                                   class="btn btn-danger btn-block w-100 rounded-pill"
                                                   onclick="return confirm('Are you sure?');">
                                                    <i class="bi bi-trash text-light"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit"
                                    class="btn btn-save btn-primary text-light px-4 rounded-pill d-block">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
