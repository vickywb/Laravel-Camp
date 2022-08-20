@extends('layouts.login')

@section('content')
<section class="login-user">
    <div class="left">
        <img src="{{ asset('images/ill_login_new.png') }}" alt="">
    </div>
    <div class="right">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="">
        <h1 class="header-third">
            Start Today
        </h1>
        <p class="subheader">
            Because tomorrow become never
        </p>
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        style="border-radius: 1rem;">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" style="border-radius: 1rem;"
                    >

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary col-md-12">
                        {{ __('Login') }}
                    </button>

                    {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif --}}
                </div>
            </div>
        </form>
        <p class="text-right mt-3 mb-0">Don't you have an account yet? <a href="{{ route('user.register') }}">Register Now!!</a></p>
        <p>
            <a class="btn btn-border btn-google-login" href="{{ route('user.google-login') }}">
                <img src="{{ asset('images/ic_google.svg') }}" class="icon" alt=""> Sign in With Google
            </a>
        </p>
        <p>
            <a class="btn btn-border btn-facebook-login" href="{{ route('user.facebook-login') }}">
                <img src="{{ asset('images/ic_facebook4.svg') }}" class="icon" alt=""> Sign in With Facebook
            </a>
        </p>
        <img src="{{ asset('images/people.png') }}" class="people" alt="">
    </div>
</section>

@endsection