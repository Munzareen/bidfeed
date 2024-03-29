<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | E-commerce</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" href="{{ asset('public/assets/images/header-logo.png') }}" />
    @include('layouts.header')
    <style>
        .active-like{
            background-color: red !important;
        }
    </style>
</head>
<body>
    @if(url()->current() != url('sign-in') && url()->current() != url('sign-up') && url()->current() != url('otp-verification') && url()->current() != url('/'))
    @include('layouts.nav')
    @endif
    @yield('content') 
    <input type="hidden" id="baseUrl" value="{{ url('/') }}" />
	<input type="hidden" id="apiBaseUrl" value="{{ $data['apiBaseUrl'] }}" />
    @if(Session::has('success')) <input type="hidden" id="mSg" color="success" value="{{ Session::get('success') }}"> @endif
	@if(Session::has('error')) <input type="hidden" id="mSg" color="error" value="{{ Session::get('error') }}"> @endif
    @if(url()->current() != url('sign-in') && url()->current() != url('sign-up') && url()->current() != url('otp-verification') && url()->current() != url('/'))
    @include('layouts.footer')
    @endif
    @include('layouts.footer-links')
</body>
</html>