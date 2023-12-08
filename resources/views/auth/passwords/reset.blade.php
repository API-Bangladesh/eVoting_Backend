@extends('auth.layout')
@section('auth')
<main id="auth">
	<div class="container">
		<form action="{{ route('password.update') }}" method="POST" class="form-auth py-5 text-center">
		 @csrf
			<h1 class="h3 mb-3 fw-normal">{{ __('Password') }}</h1>
			<div class="form-floating">
				<input type="hidden" name="token" value="{{ $token }}">
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
				<label for="email">{{ __('E-Mail Address') }}</label>
				@error('email')
					<p class="text-danger" role="alert">
						<strong>{{ $message }}</strong>
					</p>
				@enderror
			</div>
			<div class="form-floating">
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
				<label for="password">{{ __('Password') }}</label>
				@error('password')
					<p class="text-danger" role="alert">
						<strong>{{ $message }}</strong>
					</p>
				@enderror
			</div>
			<div class="form-floating">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				<label for="password-confirm">{{ __('Confirm Password') }}</label>
				@error('password')
					<p class="text-danger" role="alert">
						<strong>{{ $message }}</strong>
					</p>
				@enderror
			</div>
			<button class="w-100 btn btn-lg btn-primary" type="submit">
				{{ __('Reset Password') }}
			</button>
		</form>
	</div>
</main>
@endsection
