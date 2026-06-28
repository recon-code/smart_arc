{{-- resources/views/pages/auth/register.blade.php --}}
@extends('layouts.subtle')

@section('title', 'Register')

@section('content')
    <div class="auth-page">
        <!-- Left decorative panel -->
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

                {{-- Global error banner --}}
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

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    {{-- Role Tabs (Student / Staff) --}}
                    <div class="form-group">
                        <label class="form-label">I am a...</label>
                        <div class="role-tabs">
                            <div class="role-tab active" onclick="selectRole(this, 'student')">
                                <i class="fa fa-user-graduate"></i>
                                <span>Student</span>
                            </div>
                            <div class="role-tab" onclick="selectRole(this, 'staff')">
                                <i class="fa fa-user-tie"></i>
                                <span>Staff</span>
                            </div>
                        </div>
                        {{-- Hidden role input --}}
                        <input type="hidden" name="role" id="register-role" value="student">
                        @error('role')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

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

                    {{-- Registration No --}}
                    <div class="form-group">
                        <label class="form-label" for="reg">Registration Number <span
                                class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-user input-icon"></i>
                            <input type="text" id="reg" class="form-input @error('reg') error @enderror"
                                name="reg" value="{{ old('reg') }}" required autofocus
                                placeholder="e.g. IMC/BIT/XXXXXX" autocomplete="reg">
                        </div>
                        @error('reg')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Salute (Title) --}}
                    <div class="form-group">
                        <label class="form-label" for="salute">Salutation </label>
                        <div class="input-wrap">
                            <i class="fa fa-address-card input-icon"></i>
                            <input type="text" id="salute" class="form-input @error('salute') error @enderror"
                                name="salute" value="{{ old('salute') }}" placeholder="e.g. Mr., Ms., Dr., Prof.">
                        </div>
                        @error('salute')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address <span
                                class="required-mark">*</span></label>
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

                    {{-- Phone --}}
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number</label>
                        <div class="input-wrap">
                            <i class="fa fa-phone input-icon"></i>
                            <input type="text" id="phone" class="form-input @error('phone') error @enderror"
                                name="phone" value="{{ old('phone') }}"
                                placeholder="e.g. 0712345678 or +255712345678">
                        </div>
                        <span class="form-hint">Tanzanian number (0xx or +255xx) with 9 digits after prefix.</span>
                        @error('phone')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>


                    {{--  (Title) --}}
                    <div class="form-group">
                        <label class="form-label" for="title">Title </label>
                        <div class="input-wrap">
                            <i class="fa fa-address-card input-icon"></i>
                            {{-- <input type="text" id="title" class="form-input @error('title') error @enderror"
                                name="title" value="{{ old('title') }}"
                                placeholder="e.g. Lecturer, Dr., Prof., Eng."> --}}

                            <select class="form-select" name="title" style="padding-left:40px;">
                                <option value="">Select your title</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Loan Officer">Loan Officer</option>
                                <option value="Dean of Students">Dean of Students</option>
                            </select>
                        </div>
                        @error('title')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Faculty --}}
                    <div class="form-group">
                        <label class="form-label" for="faculty">Faculty </label>
                        <div class="input-wrap">
                            <i class="fa fa-building-columns input-icon"></i>
                            {{-- <input type="text" id="faculty" class="form-input @error('faculty') error @enderror"
                                name="faculty" value="{{ old('faculty') }}" placeholder="e.g. Faculty of Business"> --}}
                            <select class="form-select" name="faculty" style="padding-left:40px;">
                                <option value="">Select your faculty</option>
                                <option value="Insurance & Banking">Insurance & Banking</option>
                                <option value="Computing & Mathematics">Computing & Mathematics</option>
                                <option value="Business & Economics">Business & Economics</option>
                            </select>
                        </div>
                        @error('faculty')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="form-group">
                        <label class="form-label" for="department">Department</label>
                        <div class="input-wrap">
                            <i class="fa fa-sitemap input-icon"></i>
                            {{-- <input type="text" id="department" class="form-input @error('department') error @enderror"
                                name="department" value="{{ old('department') }}"
                                placeholder="e.g. Department of Information Systems"> --}}
                            <select class="form-select" name="department" style="padding-left:40px;">
                                <option value="">Select your department</option>
                                {{-- Business & Economics --}}
                                <option value="Accounting & Finance">Accounting & Finance</option>
                                <option value="Management Science">Management Science</option>
                                <option value="Tax & Economics">Tax & Economics</option>

                                {{-- computing & mathematics --}}
                                <option value="Information Technology">Information Technology</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Cyber Security">Cyber Security</option>

                                {{-- Insurance & Banking --}}
                                <option value="Banking & Financial Services">Banking & Financial Services</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Social Protection">Social Protection</option>
                            </select>
                        </div>
                        @error('department')
                            <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password">Password <span class="required-mark">*</span></label>
                        <div class="input-wrap">
                            <i class="fa fa-lock input-icon"></i>
                            <input type="password" id="password" class="form-input @error('password') error @enderror"
                                name="password" required placeholder="Create a strong password"
                                autocomplete="new-password" oninput="updatePwStrength(this.value)">
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

    {{-- JavaScript for role tabs, password toggle, and strength (same as login) --}}
    <script>
        // Role tab switching
        function selectRole(el, role) {
            // Remove active class from all tabs in the same container
            const tabs = el.closest('.role-tabs').querySelectorAll('.role-tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            el.classList.add('active');
            // Update hidden input
            document.getElementById('register-role').value = role;
        }

        // Toggle password visibility
        function togglePw(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Simple password strength indicator (optional)
        function updatePwStrength(val) {
            const wrap = document.getElementById('pw-strength-wrap');
            const bars = [
                document.getElementById('pwb1'),
                document.getElementById('pwb2'),
                document.getElementById('pwb3'),
                document.getElementById('pwb4')
            ];
            const label = document.getElementById('pw-strength-label');
            let strength = 0;
            if (val.length >= 8) strength++;
            if (val.match(/[a-z]/) && val.match(/[A-Z]/)) strength++;
            if (val.match(/\d/)) strength++;
            if (val.match(/[^a-zA-Z0-9]/)) strength++;
            // Map to 4 levels
            let level = Math.min(strength, 4);
            const levels = ['Too short', 'Weak', 'Fair', 'Good', 'Strong'];
            // Reset bars
            bars.forEach((bar, idx) => {
                bar.style.background = idx < level ? 'var(--brand-primary)' : '#e2e8f0';
            });
            label.textContent = levels[level] || 'Too short';
            wrap.style.display = val.length > 0 ? 'flex' : 'none';
        }
    </script>
@endsection
