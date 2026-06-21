@extends('layouts.subtle')

@section('title', 'Register')

@section('content')
    <div class="auth-page">
        <!-- Left decorative panel (same as login) -->
        <div class="auth-panel">
            <div class="auth-panel-grid-bg"></div>
            <div class="auth-panel-inner">
                <a href="{{ route('home') }}" class="auth-panel-logo">
                    <span class="auth-panel-logo-icon"><i class="fa fa-calendar-check"></i></span>
                    <div>
                        <span class="auth-panel-logo-text">SAASS</span>
                        <span class="auth-panel-logo-sub">Institute of Finance Management</span>
                    </div>
                </a>
                <h2 class="auth-panel-title">Start booking appointments in under a minute</h2>
                <p class="auth-panel-desc">Create your account, verify your IFM credentials, and access your personalised
                    dashboard immediately.</p>
                <div class="auth-panel-perks">
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="fa fa-calendar-check"></i></div>
                        <div class="auth-perk-text"><strong>Instant access</strong> No approval wait — book slots right away
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="fa fa-bell"></i></div>
                        <div class="auth-perk-text"><strong>Email alerts</strong> Every update lands in your inbox</div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="fa fa-shield-check"></i></div>
                        <div class="auth-perk-text"><strong>Secure &amp; private</strong> Passwords hashed with bcrypt</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Form Panel -->
        <div class="auth-form-panel">
            <div class="auth-form-wrap">
                <div class="auth-form-header">
                    <a href="{{ route('home') }}" class="auth-back"><i class="fa fa-arrow-left"></i> Back to home</a>
                    <h1 class="auth-title">Create your account</h1>
                    <p class="auth-subtitle">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                </div>

                {{-- Error / Success banners --}}
                @if ($errors->any())
                    <div class="status-banner status-banner-danger mb-4">
                        <i class="fa fa-circle-xmark"></i>
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="status-banner-close ml-auto" onclick="this.closest('.status-banner').remove()">
                            <i class="fa fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="auth-form">
                    @csrf

                    {{-- Full Name --}}
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name <span class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-user input-icon"></i>
                            <input type="text" id="name" class="form-input @error('name') error @enderror"
                                name="name" value="{{ old('name') }}" required autofocus
                                placeholder="e.g. Angel Barnaba Mtumbuka" autocomplete="name">
                        </div>
                        @error('name')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address <span class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-envelope input-icon"></i>
                            <input type="email" id="email" class="form-input @error('email') error @enderror"
                                name="email" value="{{ old('email') }}" required placeholder="yourname@ifm.ac.tz"
                                autocomplete="email">
                        </div>
                        <span class="form-hint">Use your IFM email address if you have one.</span>
                        @error('email')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password">Password <span class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-lock input-icon"></i>
                            <input type="password" id="password" class="form-input @error('password') error @enderror"
                                name="password" required placeholder="Create a strong password" autocomplete="new-password"
                                oninput="updatePwStrength(this.value)">
                            <button type="button" class="input-eye" onclick="togglePw('password', this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        {{-- Password strength meter --}}
                        <div class="pw-strength" id="pw-strength-wrap" style="display:none;">
                            <div class="pw-bars">
                                <div class="pw-bar" id="pwb1"></div>
                                <div class="pw-bar" id="pwb2"></div>
                                <div class="pw-bar" id="pwb3"></div>
                                <div class="pw-bar" id="pwb4"></div>
                            </div>
                            <span class="pw-label" id="pw-strength-label">Too short</span>
                        </div>
                        @error('password')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password <span
                                class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-lock input-icon"></i>
                            <input type="password" id="password_confirmation" class="form-input"
                                name="password_confirmation" required placeholder="Repeat your password"
                                autocomplete="new-password">
                            <button type="button" class="input-eye" onclick="togglePw('password_confirmation', this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <label class="terms-check">
                        <input type="checkbox" name="terms" id="terms" required>
                        <span class="terms-check-label">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                Policy</a>. I confirm that my registration details are accurate.
                        </span>
                    </label>

                    <div class="auth-submit">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="width:100%; justify-content:center;">
                            <i class="fa fa-user-plus"></i> Create Account
                        </button>
                    </div>
                </form>

                <p class="auth-footer-note">
                    Your information is stored securely on IFM servers.<br>
                    Questions? <a href="#">Contact the IT support desk</a>
                </p>
            </div>
        </div>
    </div>
@endsection
