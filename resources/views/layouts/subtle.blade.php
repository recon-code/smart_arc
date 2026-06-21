<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAASS — Dashboard</title>

    <!-- TailwindCSS CDN (replace with compiled build in Laravel) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Design System -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Prevent flash of wrong theme — run before render
        (function() {
            const theme = localStorage.getItem('saass_theme') || 'dark';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>

<body class="app-body">


    <!-- ==========================================================
         MAIN CONTENT AREA
         ========================================================== -->
    <main class="content-area" id="content-area" role="main">

        @yield('content')

    </main>

    {{-- @include('layouts.footer') --}}
