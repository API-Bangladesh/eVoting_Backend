@php
    $counters=get_counter_list();
@endphp

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<!--[if gte IE 9] <style type="text/css"> .gradient {filter: none;}</style><![endif]-->
<!--[if !IE]><html lang="en"><![endif]-->
<html lang="en-US" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Required meta tags for responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<!-- Favicon and touch icons -->
	<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png" />
	<meta name="misapplication-TileColor" content="#ffffff" />
	<meta name="theme-color" content="#ffffff" />
	<!-- Website title -->
	<title>Sign Up</title>
	<link rel="stylesheet" href="assets/css/bootstrap-icons.css" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	<!-- jQuery (necessary for jQuery plugins) -->
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
</head>

<body>
	<!-- Main Coding Start Here -->




	<!-- auth -->
	<main id="auth">
		<div class="container">

			<form class="form-auth py-5 text-center" action="{{route('register')}}" method="POST" >
                @csrf
				<!-- <div class="alert alert-success mb-3" role="alert">
					<p class="mb-0">Account has been created successfully ! </p>
				</div>
				<div class="alert alert-danger mb-3" role="alert">
					<p class="mb-0">Oops!! Something went wrong , please try again !! </p>
				</div> -->
				<img class="mb-4 img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="logo" width="75">
				<h1 class="h3 mb-3 fw-normal">Admin sign Up</h1>
                <div class="form-floating">
					<input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="floatingUserName" placeholder="User Name">
					<label for="floatingUserName">UserName</label>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-floating">
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="floatingUserName" placeholder="User Name">
					<label for="floatingUserName">Name</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

				<div class="form-floating">
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="floatingInput" placeholder="name@example.com">
					<label for="floatingInput">Email address</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
				</div>
				<div class="form-floating">
					<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="floatingPassword" placeholder="Password">
					<label for="floatingPassword">Password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
				</div>
                <div class="form-floating">
					<input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" id="floatingPassword" placeholder="Password">
					<label for="floatingPassword">Password</label>

				</div>
                {{-- <div class="form-floating mb-2">
                    <select class="form-select" name="type" id="user_type">
                        <option disabled selected> Select User Type </option>
                        <option value="superadmin"> Super Admin </option>
                        <option value="admin">  Admin </option>
                        <option value="presiding_officer"> Presiding  Officer </option>
                    </select>
                    <label for="user_type">Select User Type</label>
                    <script type="text/javascript">
                            $(function(){
                                if ($('#user_type').length) {
                                    $('#user_type').on('change' , function(){
                                        if ($(this).val() === 'presiding_officer') {
                                            $('#floating-counter-number').slideDown();
                                        } else {
                                            $('#floating-counter-number').slideUp();
                                        }
                                    })
                                }
                            })
                    </script>
				</div>
                <div class="form-floating mb-2" id="floating-counter-number" style="display: none">
                    <select class="form-select" name="counter_number" id="counter_number">
                        <option disabled selected> Select Counter </option>
                        @foreach($counters as $counter)
                        <option value="{{$counter->counter_number}}">  {{ $counter->counter_number }} </option>
                        @endforeach


                    </select>
                    <label for="counter_number">Select User Type</label>
				</div> --}}
				<button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
				<p class="mb-0 mt-2">
					<small>have an account?</small>
					<a href="{{url('/')}}">Sign In</a>
				</p>
				<p class="mt-5 mb-3 text-muted">
					&copy; <script type="text/javascript"> document.write(new Date().getFullYear()) </script>
				</p>
			</form>
		</div>
	</main>
	<!-- auth -->



	<!-- Main Coding End -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!-- Script JS -->
	<script src="assets/js/script.js"></script>
</body>

</html>






{{-- @extends('layouts.app') --}}


@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
