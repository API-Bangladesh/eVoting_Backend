@extends('auth.layout')

@section('auth')
    <main id="auth">
        <div class="container">

            <form action="{{ route('password.email') }}" method="POST" class="form-auth py-5 text-center">
                @csrf
                <img class="mb-4 img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="logo" width="75">
                <h1 class="h3 mb-3 fw-normal">{{ __('Reset Password') }}</h1>
                @if(session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-floating">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="floatingInput">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    @endsection

</main>
