@extends('layouts.app_no_nav')

@section('content')
		<div class="container spacing">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                	<div class="col-md-4"></div>
                	<div class="col-md-4">
                		<h1>Sign in to MXC</h1>
                		<div style="padding-top: 20px"></div>
                	</div>
                	<div class="col-md-4"></div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                <strong>Forgot your password? Click <a href="{{ route('password.request') }}">here</a> to reset it.</strong>
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
                                {{ __('Remember me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-raised btn-mobile">
                            {{ __('Login') }}
                        </button>
                        <a href="{{ route('register') }}" class="btn btn-link btn-mobile">Register</a>
                    </div>
                </div>
            </form>
		</div>
@endsection
