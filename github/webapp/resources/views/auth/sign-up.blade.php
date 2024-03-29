@extends('layouts.master')
@section('title', 'Sign up')
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
                            <h1 class="auth-title">Create your account</h1>
                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                        </div>
                        <div>
                            <form class="auth-form" id="register-form">
                                <div class="form-group">
                                    <input type="text" placeholder="Name" name="user_name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Email" name="user_email" required>
                                </div>
                                <div class="form-group password-group">
                                    <input type="password" placeholder="Password" name="user_password" required>
                                    <a href="#!"><img src="{{ asset('public/assets/images/password-hide.png') }}" alt="icon" class="img-fluid"></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="privacy-check">
                                    <label class="form-check-label" for="privacy-check">
                                        I agree to BidFeed Terms of service and Privacy Policy.
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="user_device_token" value="12300" name="user_device_token">
                                    <input type="hidden" class="user_device_token" value="web" name="user_device">
                                    <button type="submit" class="submit-btn">Sign Up</button>
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