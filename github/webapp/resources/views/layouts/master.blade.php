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
        .error{
            color: red;
        }

        /* Safari */
		@-webkit-keyframes spin {
			0% {
				-webkit-transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
			}
		}

		@keyframes  spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
        .list-group {
			position: absolute;
			width: 100%;
			z-index: 9999;
			height: 410px;
			overflow-y: auto;
		}
		.list-group-item {
			padding: 10px 20px;
		}
		.list-group-item a {
			color: #282828;
			font-size: 14px;
			transition: all 0.25s;
		}
		.list-group-item:hover a {
			font-weight: 600;
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