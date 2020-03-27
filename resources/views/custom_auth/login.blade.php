@extends('layouts.auth_template')

@push('custom_css')

@endpush



@section('content')

    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                    @csrf
                    <div class="account-logo">
                        <a href="index-2.html"><img src="/img/logo-dark.png" alt=""></a>
                    </div>
                    <div class="form-group @error('email') is-invalid @enderror">
                        <label>Username or Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('custom_scripts')

@endpush









{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}


{{--<!-- login23:11-->--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">--}}
{{--    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">--}}
{{--    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>--}}
{{--    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="/css/style.css">--}}
{{--    <![endif]-->--}}
{{--</head>--}}

{{--<body>--}}
{{--<div class="main-wrapper account-wrapper">--}}
{{--    <div class="account-page">--}}
{{--        <div class="account-center">--}}
{{--            <div class="account-box">--}}
{{--                <form action="{{ route('login') }}" class="form-signin">--}}
{{--                    @csrf--}}
{{--                    <div class="account-logo">--}}
{{--                        <a href="index-2.html"><img src="/img/logo-dark.png" alt=""></a>--}}
{{--                    </div>--}}
{{--                    <div class="form-group @error('email') is-invalid @enderror">--}}
{{--                        <label>Username or Email</label>--}}
{{--                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                        @error('email')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Password</label>--}}
{{--                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                        @error('password')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group text-right">--}}
{{--                        <a href="forgot-password.html">Forgot your password?</a>--}}
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group text-center">--}}
{{--                        <button type="submit" class="btn btn-primary account-btn">Login</button>--}}
{{--                    </div>--}}
{{--                    <div class="text-center register-link">--}}
{{--                        Don’t have an account? <a href="register.html">Register Now</a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<script src="/js/jquery-3.2.1.min.js"></script>--}}
{{--<script src="/js/popper.min.js"></script>--}}
{{--<script src="/js/bootstrap.min.js"></script>--}}
{{--<script src="/js/template.js"></script>--}}
{{--</body>--}}


{{--<!-- login23:12-->--}}
{{--</html>--}}
