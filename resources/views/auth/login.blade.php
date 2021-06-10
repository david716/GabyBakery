@extends('layouts.app')
@section('style')
    <style>
        body {
            background: url(images/fondo_login.jpg);
            -webkit-background-size: cover;
            background-size: cover;
            min-height: 100vh;
        }
        .margin{
            margin-top: 150px;
        }
    </style>
@endsection
@section('content')
<div class="container margin">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card_login">
            <img src="{{ asset('images/logo.jpg') }}" class="avatar_login">
                <div class="card-body card-body_login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group form-group_login row">
                            <label for="email" class="col-md-6 col-form-label label_login">{{ __('E-Mail') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control_login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group_login row">
                            <label for="password" class="col-md-6 col-form-label label_login">{{ __('Password') }}</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control form-control_login @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <center>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn_login">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
