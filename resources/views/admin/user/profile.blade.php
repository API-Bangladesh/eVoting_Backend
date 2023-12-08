@extends('admin.layout.master')
@section('title', 'Profile')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Profile Information</h3>

            @include('common.alert-message')

            <div class="row">
                <div class="col-xxl-8">
                    <form action="{{ route('update-profile', auth()->id()) }}" method="post"
                          class="p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="old_image" value="{{ $user->image }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group d-md-flex align-items-center gap-3 mb-3">
                            <div class="current-user-profile-img mb-2">
                                <img src="{{ get_uploaded_file_url($user->image) }}" alt="img"
                                     id="current-user-profile-img"
                                     class="img-fluid rounded" width="85"/>
                            </div>
                            <div class="d-flex flex-column">
                                <input type="file" name="image" id="input-user-img" onChange="img_preview(this);"
                                       accept="image/jpeg, image/jpg, image/png"/>
                                @error('image')
                                <p class="text-danger ">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label mb-1">Username</label>
                                    <input type="text" class="form-control " id="username" name="username"
                                           value="{{ old('username', $user->username) }}" placeholder="Username"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('username')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label mb-1">Name</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $user->name) }}" id="name" placeholder="Full Name"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('name')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label mb-1">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{ old('email', $user->email) }}" id="email" placeholder="Email"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('email')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label mb-1">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           autocomplete="new-password" placeholder="password"/>
                                </div>
                                <div class="text-start offset-lg-3 col-12 col-lg-9">
                                    @error('password')
                                    <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function img_preview(input) {
            $('#current-user-profile-img')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }
    </script>
@endsection
