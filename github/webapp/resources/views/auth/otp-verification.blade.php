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
                            <h1 class="auth-title">Enter OTP</h1>
                        </div>
                        <div>
                            <form class="auth-form" id="otp-from">
                                <div class="form-group">
                                    <input type="text" placeholder="Otp" name="otp" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="otp-btn" class="submit-btn">Verify</button>
                                    <button type="button" id="resend-otp" class="submit-btn">Resend OTP</button>
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