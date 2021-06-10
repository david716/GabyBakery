@extends('layouts.app')
@section('style')
    <style>
        body {
            background: url(images/fondo_registro.jpg);
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
        <div class="col-md-8">
            <div class="card card_registro">
            <img src="{{ asset('images/logo.jpg') }}" class="avatar_registro">
                <div class="card-body card-body_registro">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="col-md-8 col-form-label label_registro">Nombre y Apellido</label>
                                    <input id="name" type="text" maxlength="20" minlength="5" class="form-control form-control_registro @error('name') is-invalid @enderror " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="col-md-8 col-form-label label_registro">{{ __('E-Mail') }}</label>
                                    <input id="email" type="email" minlength="5" class="form-control form-control_registro @error('email') is-invalid @enderror input_registro" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">                        
                                <div class="form-group">
                                <label for="adress" class="col-md-8 col-form-label label_registro">Direccion</label>
                                    <input id="adress" type="text" minlength="5" class="form-control form-control_registro @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}" required autofocus>

                                    @error('adress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="phone" class="col-md-8 col-form-label label_registro">Telefono</label>
                                    <input id="phone" type="tel" minlength="10" maxlength="10" class="form-control form-control_registro @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="password" class="col-md-8 col-form-label label_registro">Contraseña</label>
                                    <input id="password" type="password" class="form-control form-control_registro @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="password-confirm" class="col-md-16 col-form-label label_registro">Confirmar Contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control form-control_registro" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <center>
                            <div class="form-group ">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn_registro">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
