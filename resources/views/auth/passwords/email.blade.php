@extends('layouts.app_no_nav')

@section('content')
        <div class="container spacing">

            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h1>Password reset</h1>
                        <div style="padding-top: 20px"></div>
                    </div>
                    <div class="col-md-4"></div>
            </div>

            @if (session('status'))
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <br />
                        <button type="submit" class="btn btn-primary btn-raised">
                            {{ __('Reset password') }} 
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-link">Back to login</a>
                    </div>
                </div>
            </form>
        </div>
@endsection
