<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAASS — Smart Academic Appointment & Scheduling System</title>
    <!-- FontAwesome Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Design System -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Prevent flash of wrong theme
        (function() {
            try {
                const t = localStorage.getItem('saass_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', t);
            } catch (e) {}
        })();
    </script>
</head>

<body>
    <!-- ================================================================
     PAGE SWITCHER (demo only — remove in production)
     In Laravel each page is its own Blade route
     ================================================================ -->
    {{-- <nav class="demo-switcher" id="demo-switcher">
        <button class="demo-btn active" onclick="showPage('landing')"><i class="fa fa-house"></i> Landing</button>
        <button class="demo-btn" onclick="showPage('login')"><i class="fa fa-right-to-bracket"></i> Login</button>
        <button class="demo-btn" onclick="showPage('register')"><i class="fa fa-user-plus"></i> Register</button>
        <button class="demo-btn" onclick="showPage('contact')"><i class="fa fa-envelope"></i> Contact</button>
    </nav> --}}
    <!-- PUB NAV -->
    <nav class="pub-nav" id="pub-nav-landing">
        <div class="pub-nav-inner">
            <a href="/" class="pub-logo" onclick="showPage('landing')">
                <span class="pub-logo-icon"><i class="fa fa-calendar-check"></i></span>
                <span class="pub-logo-text">SAA<span>SS</span></span>
            </a>
            <div class="pub-nav-links">
                <a href="#features" class="pub-nav-link" onclick="smoothScroll(event,'features-section')">Features</a>
                <a href="#how" class="pub-nav-link" onclick="smoothScroll(event,'hiw-section')">How it works</a>
                <a href="#roles" class="pub-nav-link" onclick="smoothScroll(event,'roles-section')">Who it's for</a>
                <a href="#contact" class="pub-nav-link" onclick="showPage('contact'); return false;">Contact</a>
            </div>
            <div class="pub-nav-right">
                <button class="pub-nav-theme" id="theme-toggle-landing" title="Toggle theme">
                    <i class="fa fa-moon" id="theme-icon-landing"></i>
                </button>
                <a href="/login" class="btn btn-outline-white btn-sm">Login</a>
                <a href="/register" class="btn btn-white btn-sm">Get
                    Started</a>
                <button class="pub-nav-burger" id="burger-landing"><i class="fa fa-bars"></i></button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="pub-mobile-menu" id="mobile-menu-landing">
        <button class="pub-mobile-close" onclick="closeMobileMenu('mobile-menu-landing')"><i
                class="fa fa-xmark"></i></button>
        <a href="#" class="pub-mobile-link" onclick="closeMobileMenu('mobile-menu-landing')"><i
                class="fa fa-house"></i> Home</a>
        <a href="#" class="pub-mobile-link" onclick="closeMobileMenu('mobile-menu-landing')"><i
                class="fa fa-star"></i> Features</a>
        <a href="#" class="pub-mobile-link" onclick="closeMobileMenu('mobile-menu-landing')"><i
                class="fa fa-circle-question"></i> How it works</a>
        <a href="#" class="pub-mobile-link" onclick="closeMobileMenu('mobile-menu-landing')"><i
                class="fa fa-users"></i> Who it's for</a>
        <div class="pub-mobile-divider"></div>
        <a href="#" class="pub-mobile-link"
            onclick="showPage('contact'); closeMobileMenu('mobile-menu-landing'); return false;"><i
                class="fa fa-envelope"></i> Contact</a>
        <div
            style="margin-top: auto; display: flex; flex-direction: column; gap: var(--space-3); padding-top: var(--space-6);">
            <a href="/login" class="btn btn-outline" style="justify-content:center;">Login</a>
            <a href="#" class="btn btn-primary" onclick="showPage('register'); return false;"
                style="justify-content:center;">Get Started — It's Free</a>
        </div>
    </div>

    <!-- ==========================================================
         MAIN CONTENT AREA
         ========================================================== -->
    <div class="page active" id="page-landing">
        @yield('content')


        <!-- PUBLIC FOOTER -->
        <footer class="pub-footer">
            <div class="pub-footer-inner">
                <div class="pub-footer-grid">
                    <div>
                        <div
                            style="display:flex; align-items:center; gap:var(--space-3); margin-bottom:var(--space-4);">
                            <div class="pub-logo-icon"><i class="fa fa-calendar-check"></i></div>
                            <span style="font-size:1.1rem; font-weight:800; color:#fff;">SAASS</span>
                        </div>
                        <p class="footer-brand-desc">Smart Academic Appointment &amp; Scheduling System. A final year
                            project by BIT Group — Institute of Finance Management, 2025/2026.</p>
                        <div class="footer-social" style="margin-top:var(--space-5);">
                            <a href="#" class="footer-social-link"><i class="fa-brands fa-github"></i></a>
                            <a href="#" class="footer-social-link"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#" class="footer-social-link"><i class="fa fa-envelope"></i></a>
                        </div>
                    </div>
                    <div>
                        <p class="footer-col-title">Platform</p>
                        <ul class="footer-links">
                            <li><a href="#" class="footer-link">Features</a></li>
                            <li><a href="#" class="footer-link">How it works</a></li>
                            <li><a href="#" class="footer-link">Who it's for</a></li>
                            <li><a href="#" class="footer-link"
                                    onclick="showPage('contact'); return false;">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="footer-col-title">Account</p>
                        <ul class="footer-links">
                            <li><a href="/login" class="footer-link">Logins</a></li>
                            <li><a href="#" class="footer-link"
                                    onclick="showPage('register'); return false;">Register</a></li>
                            <li><a href="#" class="footer-link">Reset Password</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="footer-col-title">Institute</p>
                        <ul class="footer-links">
                            <li><a href="#" class="footer-link">IFM Official Site</a></li>
                            <li><a href="#" class="footer-link">Faculty of Computing</a></li>
                            <li><a href="#" class="footer-link">Academic Calendar</a></li>
                            <li><a href="#" class="footer-link">Student Portal</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pub-footer-bottom">
                    <span>© 2026 SAASS &mdash; Institute of Finance Management. BIT Year 3 Group Project.</span>
                    <span>Built with Laravel 13 &middot; MySQL &middot; Tailwind CSS</span>
                </div>
            </div>
        </footer>
    </div><!-- end .page -->

    {{-- @include('layouts.footer') --}}
