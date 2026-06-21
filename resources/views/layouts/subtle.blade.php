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


    <!-- ==========================================================
         MAIN CONTENT AREA
         ========================================================== -->
    <div class="page active" id="page-landing">
        @yield('content')



    </div><!-- end .page -->

    {{-- @include('layouts.footer') --}}
