@extends('auth.layout')

@section('auth')
<main id="auth">
	<div class="container">
		<form action="{{ route('password.confirm') }}" method="POST" class="form-auth py-5 text-center">
		 @csrf
			<h1 class="mb-2 fw-normal">{{ __('Confirm Password') }}</h1>
			<p class="mb-3 fw-normal">{{ __('Please confirm your password before continuing.') }}</p>
			<div class="form-floating">
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
				<label for="password">{{ __('Password') }}</label>
				@error('password')
					<p class="text-danger" role="alert">
						<strong>{{ $message }}</strong>
					</p>
				@enderror
			</div>
			<button type="submit" class="w-100 btn btn-lg btn-primary">
				{{ __('Confirm Password') }}
			</button>
			@if(Route::has('password.request'))
				<a class="btn btn-link" href="{{ route('password.request') }}">
					{{ __('Forgot Your Password?') }}
				</a>
			@endif
		</form>
	</div>
</main>

@endsection
