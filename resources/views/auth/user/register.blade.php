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
        <form action="{{ route('user.store-data') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        style="border-radius: 1rem;">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

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
                <label for="address" class="form-label">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                        name="address" value="{{ old('address') }}" required autocomplete="address" autofocus
                        style="border-radius: 1rem;">

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>

                <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus
                        style="border-radius: 1rem;">

                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="row mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required style="border-radius: 1rem;">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required style="border-radius: 1rem;">
                </div>
            </div>
            
            <div class="row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary col-md-12">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
        <img src="{{ asset('images/people.png') }}" class="people" alt="">
    </div>
</section>

@endsection