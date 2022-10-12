@extends('layouts.auth-user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1 mt-5">
            @include('partials._messages')
            <div class="card mt-3">
                <div class="card-header">
                    <span>Change Password</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store-password') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="old_password" class="form-label">{{ __('Old Password') }}</label>
                
                            <div class="col-md-10">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" style="border-radius: 1rem;"
                                >
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <span id="#old_password"><i class="bi bi-eye-fill toggle-password"></i></span>
                             </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="password" class="form-label">{{ __('New Password') }}</label>
                
                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="password" required style="border-radius: 1rem;"
                                >
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <span id="#password"><i class="bi bi-eye-fill toggle-password2"></i></span>
                             </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirmation" class="form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-10">
                                <input id="password-confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required style="border-radius: 1rem;">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <span id="#password-confirmation"><i class="bi bi-eye-fill toggle-password3"></i></span>
                             </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-5">
                              <a href="{{ route('user.dashboard') }}" class="btn btn-secondary col-md-12" style="border-radius: 1rem">Cancel</a>
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary col-md-12" style="border-radius: 1rem;">
                                    {{ __('Save New Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.toggle-password').click(function () {
            
            $(this).toggleClass('bi bi-eye-slash-fill');
            var input = document.getElementById('old_password');
            if (input.type == 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
        $('.toggle-password2').click(function () {
            
            $(this).toggleClass('bi bi-eye-slash-fill');
            var input = document.getElementById('password');
            if (input.type == 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
        $('.toggle-password3').click(function () {
            
            $(this).toggleClass('bi bi-eye-slash-fill');
            var input = document.getElementById('password-confirmation');
            if (input.type == 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    </script>
@endsection