@extends('layouts.subtle')

@section('title', 'Sign In')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="w-full max-w-md">
            <div class="card shadow-soft">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-sign-in-alt"></i> Welcome Back
                    </h3>
                </div>

                <div class="card-body">
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

                    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address <span
                                    class="required-mark">*</span></label>
                            <input type="email" id="email" class="form-input @error('email') error @enderror"
                                name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                                placeholder="your@email.com" />
                            @error('email')
                                <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label class="form-label" for="password">Password <span class="required-mark">*</span></label>
                            <input type="password" id="password" class="form-input @error('password') error @enderror"
                                name="password" required autocomplete="current-password" placeholder="••••••••" />
                            @error('password')
                                <span class="form-error"><i class="fa fa-circle-xmark"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        {{-- Forgot Password --}}
                        @if (Route::has('password.request'))
                            <div class="text-right text-sm">
                                <a href="{{ route('password.request') }}" class="text-brand-accent hover:underline">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary w-full justify-center">
                            <i class="fa fa-arrow-right-to-bracket"></i> Log In
                        </button>

                        {{-- Register link --}}
                        <div class="text-center text-sm text-muted">
                            Don't have an account?
                            {{-- <a href="{{ route('register') }}" class="text-brand-accent font-semibold hover:underline">
                                Sign up
                            </a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
