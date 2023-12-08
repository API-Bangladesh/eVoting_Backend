@extends('admin.layout.master')
@section('title', 'Assign Permissions')

@section('content')
    <!-- dashboard -->
    <main id="dashboard">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h3 class="fs-3 fw-normal mb-4">
                    Assign permissions for : {{ $role->name }}
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

            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <form action="{{ url("update-role/{$role->id}/permissions") }}" method="post">
                    @csrf
                    @method('PUT')

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="font-weight-bold" width="20%">
                                Modules
                                <i class="mdi mdi-information"></i>
                            </th>
                            <th class="font-weight-bold">
                                Permissions
                                <i class="mdi mdi-information"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissionList as $module => $permissions)
                            <tr>
                                <td>
                                    <div class="custom-btn-check d-flex align-items-center">
                                        <input type="checkbox" class="check-all-checkbox-row me-2"
                                               id="lbl-{{ $module }}"
                                               @if(reset($permissions) && $role->hasPermissionTo(reset($permissions))) checked @endif>
                                        <label class="btn btn-outline-dark btn-sm font-weight-bold"
                                               for="lbl-{{ $module }}">
                                            {{ get_dashes_to_title_case($module) }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        @foreach($permissions as $action => $permission)
                                            <div class="form-check me-5">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permissions[]"
                                                           value="{{ $permission }}"
                                                           @if($permission && $role->hasPermissionTo($permission)) checked
                                                           @endif
                                                           class="form-check-input">
                                                    {{ get_dashes_to_title_case($action) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row align-items-center form-group mb-3">
                        <div class="col flex-grow-1">
                            <button type="submit" class="btn btn-primary text-light px-4 rounded-pill">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- dashboard -->
@endsection
