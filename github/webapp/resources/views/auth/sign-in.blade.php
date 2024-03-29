@extends('layouts.master')
@section('title', 'Sign in')
@section('content')

<section class="auth-sec">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="form-col">
                <div class="auth-form-wrap sign-up-form">
                    <div class="auth-logo">
                        <img src="{{ asset('public/assets/images/auth-logo.svg') }}" alt="logo" class="img-fluid">
                    </div>
                    <div class="auth-text">
                        <h1 class="auth-title">Enter your email & choose you password</h1>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                    </div>
                    <div>
                        <form class="auth-form" id="login-form">
                            <div class="form-group">
                                <input type="text" placeholder="Email" name="user_email">
                            </div>
                            <div class="form-group password-group">
                                <input type="password" placeholder="Password" name="user_password">
                                <a href="#!"><img src="{{ asset('public/assets/images/password-hide.png') }}" alt="icon" class="img-fluid"></a>
                            </div>

                            <div class="sign-in-checks">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember-pass">
                                    <label class="form-check-label" for="remember-pass">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#!" class="forget-pass">Forget your password?</a>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="device_token" class="device_token">
                                <button type="submit" id="login-btn" class="submit-btn">Sign In</button>
                            </div>
                            <div class="alternate-login">
                                <p>or continue with</p>
                                <div class="login-opts">
                                    <a href="#!">
                                        <img src="{{ asset('public/assets/images/icon-google.png') }}" alt="icon" class="img-fluid">
                                    </a>
                                    <a href="#!">
                                        <img src="{{ asset('public/assets/images/icon-fb.png') }}" alt="icon" class="img-fluid">
                                    </a>
                                    <a href="#!">
                                        <img src="{{ asset('public/assets/images/icon-apple.png') }}" alt="icon" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="gallery-col">
                <img src="{{ asset('public/assets/images/auth-gallery-img.png') }}" alt="img" class="img-fluid">
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/auth.js') }}"></script> 
@endpush