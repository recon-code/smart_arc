@extends('layouts.subtle')

@section('title', 'Sign In')

@section('content')
    <!-- ================================================================
                                         PAGE 2: LOGIN (resources/views/auth/login.blade.php)
                                         Route: GET /login → AuthController@showLogin
                                         POST /login → AuthController@login
                                         ================================================================ -->
    <div id="page-login">
        <div class="auth-page">

            <!-- Left Panel -->
            <div class="auth-panel">
                <div class="auth-panel-grid-bg"></div>
                <div class="auth-panel-inner">
                    <a href="#" class="auth-panel-logo" onclick="showPage('landing'); return false;">
                        <span class="auth-panel-logo-icon"><i class="fa fa-calendar-check"></i></span>
                        <div>
                            <span class="auth-panel-logo-text">SAASS</span>
                            <span class="auth-panel-logo-sub">Institute of Finance Management</span>
                        </div>
                    </a>
                    <h2 class="auth-panel-title">Welcome back to smarter scheduling</h2>
                    <p class="auth-panel-desc">Students, staff, and admins all use the same login. We'll take you to the
                        right dashboard automatically.</p>
                    <div class="auth-panel-perks">
                        <div class="auth-perk">
                            <div class="auth-perk-icon"><i class="fa fa-bolt"></i></div>
                            <div class="auth-perk-text"><strong>Instant redirect</strong> Role-based dashboard on login
                            </div>
                        </div>
                        <div class="auth-perk">
                            <div class="auth-perk-icon"><i class="fa fa-lock"></i></div>
                            <div class="auth-perk-text"><strong>Secure sessions</strong> Laravel Sanctum-protected</div>
                        </div>
                        <div class="auth-perk">
                            <div class="auth-perk-icon"><i class="fa fa-rotate"></i></div>
                            <div class="auth-perk-text"><strong>Password reset</strong> Via your IFM email address</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="auth-form-panel">
                <div class="auth-form-wrap">
                    <div class="auth-form-header">
                        <a href="#" class="auth-back" onclick="showPage('landing'); return false;"><i
                                class="fa fa-arrow-left"></i> Back to home</a>
                        <h1 class="auth-title">Sign in to SAASS</h1>
                        <p class="auth-subtitle">Don't have an account? <a href="{{ route('register') }}">Register here</a>
                        </p>
                    </div>


                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="status-banner status-banner-success mb-4">
                            <i class="fa fa-check-circle"></i>
                            {{ session('status') }}
                            <button class="status-banner-close ml-auto" onclick="this.closest('.status-banner').remove()">
                                <i class="fa fa-xmark"></i>
                            </button>
                        </div>
                    @endif

                    {{-- Session Status --}}
                    @if (session('success'))
                        <div class="status-banner status-banner-success mb-4">
                            <i class="fa fa-check-circle"></i>
                            {{ session('success') }}
                            <button class="status-banner-close ml-auto" onclick="this.closest('.status-banner').remove()">
                                <i class="fa fa-xmark"></i>
                            </button>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="status-banner status-banner-danger mb-4">
                            <i class="fa fa-circle-exclamation"></i>
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
                    <!-- ERROR BANNER EXAMPLE (show when login fails) -->
                    {{-- <div class="status-banner"
                        style="background:var(--bg-denied); color:#b91c1c; border:1px solid rgba(239,68,68,0.3); margin-bottom:var(--space-4); display:none;"
                        id="login-error">
                        <i class="fa fa-circle-xmark"></i>
                        <span>These credentials do not match our records.</span>
                        <button class="status-banner-close"><i class="fa fa-xmark"></i></button>
                    </div> --}}

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="auth-form">
                            <!-- Role selector -->
                            <div class="form-group">
                                <label class="form-label">I am a...</label>
                                <div class="role-tabs">
                                    <div class="role-tab active" onclick="selectRole(this,'student')">
                                        <i class="fa fa-user-graduate"></i>
                                        <span>Student</span>
                                    </div>
                                    <div class="role-tab" onclick="selectRole(this,'staff')">
                                        <i class="fa fa-user-tie"></i>
                                        <span>Staff</span>
                                    </div>
                                    <div class="role-tab" onclick="selectRole(this,'admin')">
                                        <i class="fa fa-shield-halved"></i>
                                        <span>Admin</span>
                                    </div>
                                </div>
                                <!-- Laravel: <input type="hidden" name="role" id="login-role" value="student"> -->
                            </div>

                            <!-- ID field - label changes based on role -->
                            <div class="form-group">
                                <label class="form-label" id="login-id-label">Registration Number <span
                                        class="required-mark">*</span></label>
                                <div class="input-wrap">
                                    <i class="fa fa-id-card input-icon"></i>
                                    <!-- Laravel: name="identifier" old value: {{ old('identifier') }} -->
                                    <!-- Laravel: @error('identifier')
        add class 'error'
    @enderror -->
                                    <input type="text" class="form-input" id="login-id" name="email"
                                        placeholder="e.g. IMC/BIT/2314470" autocomplete="username">
                                </div>
                                <!-- Laravel: @error('identifier')
        <span class="form-error">{{ $message }}</span>
    @enderror -->
                            </div>

                            <div class="form-group">
                                <div style="display:flex; align-items:center; justify-content:space-between;">
                                    <label class="form-label">Password <span class="required-mark">*</span></label>
                                    <a href="#" style="font-size:0.78rem; color:var(--brand-accent);">Forgot
                                        password?</a>
                                    <!-- Laravel: route('password.request') -->
                                </div>
                                <div class="input-wrap">
                                    <i class="fa fa-lock input-icon"></i>
                                    <!-- Laravel: name="password" -->
                                    <input type="password" class="form-input" id="login-pw" placeholder="Your password"
                                        autocomplete="current-password" name="password">
                                    <button type="button" class="input-eye" onclick="togglePw('login-pw',this)"><i
                                            class="fa fa-eye"></i></button>
                                </div>
                            </div>

                            <div style="display:flex; align-items:center; justify-content:space-between;">
                                <label class="terms-check">
                                    <!-- Laravel: name="remember" -->
                                    <input type="checkbox" id="remember" name="remember">
                                    <span class="terms-check-label">Remember me for 30 days</span>
                                </label>
                            </div>

                            <div class="auth-submit">
                                <!-- Laravel: type="submit" -->
                                <button class="btn btn-primary" onclick="demoLogin()">
                                    <i class="fa fa-right-to-bracket"></i> Sign In
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="auth-footer-note">
                        Having trouble? <a href="#" onclick="showPage('contact'); return false;">Contact the IT
                            desk</a><br>
                        IFM SAASS — <a href="/">Return to homepage</a>
                    </p>
                </div>
            </div>
        </div>
    </div><!-- end #page-login -->

@endsection
