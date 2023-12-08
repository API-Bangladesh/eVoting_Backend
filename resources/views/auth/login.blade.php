@extends('auth.layout')
@section('auth')
    <main id="auth">
        <div class="container">
            <form action="{{ route('login') }}" method="POST" class="form-auth py-5 text-center" autocomplete="off">
                @csrf
                <img class="mb-4 img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="logo" width="75">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                @include('common.alert-message')

                <div class="form-floating">
                    <input type="text" class="form-control @error('username') is-invalid @enderror " name="email"
                           id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address or username</label>
                    @error('username')
                    <span class="invalid-feedback mb-3" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="floatingPassword" placeholder="Password" name="password" autocomplete="new-password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <span class="invalid-feedback mb-3" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="checkbox my-3">
                    <label for="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
                {{-- <a href="{{route('home')}}" class="w-100 btn btn-lg btn-primary">Sign In</a> --}}
                {{-- <p class="mb-0 mt-2">
                    <small>Don't have an account?</small>
                    <a href="{{route('register')}}">Sign Up</a>
                </p> --}}
                @if(Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <p class="mt-5 mb-3 text-muted">
                    &copy;
                    <script type="text/javascript"> document.write(new Date().getFullYear()) </script>
                </p>
            </form>
        </div>
    </main>
@endsection





{{-- @section('content') --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if(Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}
