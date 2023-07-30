@extends('layouts.app')

@section('content')
    <div class="frame">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Iniciar sesión') }}</div> -->
                    <div class="nav">

                        <!-- <form method="POST" action="{{ route('login') }}"> -->
                            <!-- <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"></label>
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
                                <label for="password" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> -->
                                        <form class="form-signin"  method="POST" action="{{ route('login') }}" name="form">
                                        @csrf
                                        <h1>{{__('Iniciar Sesión')}}</h1>
                                        <label for="username">{{ __('E-Mail') }}</label>
                                        <input class="form-styling" type="email" name="email" placeholder=""/>
                                        <label for="password">{{ __('Contraseña') }}</label>
                                        <input class="form-styling" type="password" name="password" placeholder=""/>
                                        <div class="btn-animate">
                                        <button type="submit" class="btn-signin">
                                            {{ __('Ingresar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
