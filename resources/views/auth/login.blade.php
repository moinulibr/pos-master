<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

<!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/pages_authentication_login-v2.html by HTTrack Website Copier/3.x [XR&CO2014], Sun, 21 Jun 2020 10:58:57 GMT -->
<head>
<title>Empire | B4+ admin template</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="description" content="Empire is one of the unique admin template built on top of Bootstrap 4 framework. It is easy to customize, flexible code styles, well tested, modern & responsive are the topmost key factors of Empire Dashboard Template" />
<meta name="keywords" content="bootstrap admin template, dashboard template, backend panel, bootstrap 4, backend template, dashboard template, saas admin, CRM dashboard, eCommerce dashboard">
<meta name="author" content="Codedthemes" />
<link rel="icon" type="image/x-icon" href="{{asset('backend/links/assets')}}/img/favicon.ico">

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/fontawesome.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/ionicons.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/linearicons.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/open-iconic.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/pe-icon-7-stroke.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/fonts/feather.css">

<link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/bootstrap-material.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/shreerang-material.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/uikit.css">

<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/perfect-scrollbar/perfect-scrollbar.css">

<link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/pages/authentication.css">
</head>
<body>

<div class="page-loader">
<div class="bg-primary"></div>
</div>


<div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('{{asset('backend/links/assets')}}/img/bg/21.jpg');">
<div class="ui-bg-overlay bg-dark opacity-25"></div>
<div class="authentication-inner py-5">
<div class="card">
<div class="p-4 p-sm-5">

<div class="d-flex justify-content-center align-items-center pb-2 mb-4">
<div class="ui-w-60">
<div class="w-100 position-relative">
<img src="{{asset('backend/links/assets')}}/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
<div class="clearfix"></div>
</div>
</div>
</div>

<h5 class="text-center text-muted font-weight-normal mb-4">Login to Your Account</h5>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label class="form-label">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <label class="form-label d-flex justify-content-between align-items-end">
            <span>Password</span>
            <a href="#" class="d-block small">Forgot password?</a>
        </label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="clearfix"></div>
    </div>
    <div class="d-flex justify-content-between align-items-center m-0">
        <label class="custom-control custom-checkbox m-0">
        <input type="checkbox" class="custom-control-input">
        <span class="custom-control-label">Remember me</span>
        </label>
        <input type="submit" class="btn btn-primary" value="Sign In">
    </div>
</form>

</div>
<div class="card-footer py-3 px-4 px-sm-5">
<div class="text-center text-muted">
Don't have an account yet?
<a href="#">Sign Up</a>
</div>
</div>
</div>
</div>
</div>


<script src="{{asset('backend/links/assets')}}/js/pace.js"></script>
<script src="{{asset('backend/links/assets')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/popper/popper.js"></script>
<script src="{{asset('backend/links/assets')}}/js/bootstrap.js"></script>
<script src="{{asset('backend/links/assets')}}/js/sidenav.js"></script>
<script src="{{asset('backend/links/assets')}}/js/layout-helpers.js"></script>
<script src="{{asset('backend/links/assets')}}/js/material-ripple.js"></script>

<script src="{{asset('backend/links/assets')}}/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{asset('backend/links/assets')}}/js/demo.js"></script><script src="{{asset('backend/links/assets')}}/js/analytics.js"></script>
</body>

<!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/pages_authentication_login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 10:58:57 GMT -->
</html>


{{--
@extends('layouts.app')

@section('content')
<div class="container">
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

                                @if (Route::has('password.request'))
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
@endsection
- --}}
