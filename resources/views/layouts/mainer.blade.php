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

    <!-- ============================================================
     SIDEBAR COMPONENT
     Split into: resources/views/components/sidebar.blade.php
     ============================================================ -->
    <aside id="sidebar" class="sidebar" aria-label="Main navigation">

        <!-- Sidebar Header / Logo -->
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <span class="logo-icon"><i class="fa fa-calendar-check"></i></span>
                <span class="logo-text">SMART_SCHEDULE</span>
            </div>
            <!-- Close button (mobile only) -->
            <button id="sidebar-close" class="sidebar-close-btn" aria-label="Close sidebar">
                <i class="fa fa-xmark"></i>
            </button>
        </div>

        <!-- Role Badge -->
        <div class="sidebar-role-badge">
            <span class="role-indicator role-staff">Staff — Lecturer</span>
        </div>

        <!-- Navigation Links -->
        <nav class="sidebar-nav" aria-label="Sidebar navigation">
            <ul class="nav-list">

                <!-- Dashboard -->
                <li class="nav-item active">
                    <a href="/staff/dashboard" class="nav-link">
                        <i class="fa fa-gauge-high nav-icon"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                <!-- Schedule -->
                <li class="nav-item">
                    <a href="/staff/schedule" class="nav-link">
                        <i class="fa fa-paper-plane nav-icon"></i>
                        <span class="nav-label">My Schedule</span>
                    </a>
                </li>

                <!-- Appointments -->
                <li class="nav-item">
                    <a href="/staff/appointments" class="nav-link">
                        <i class="fa fa-clock-rotate-left nav-icon"></i>
                        <span class="nav-label">Appointments</span>
                        <span class="nav-badge">5</span>
                    </a>
                </li>

                <!-- Timetable Upload -->
                <li class="nav-item">
                    <a href="/staff/schedule/timetable" class="nav-link">
                        <i class="fa fa-file-arrow-up nav-icon"></i>
                        <span class="nav-label">Upload Timetable</span>
                    </a>
                </li>

                <!-- Staff Directory (visible to students) -->
                <li class="nav-item">
                    <a href="/student/staff" class="nav-link">
                        <i class="fa fa-address-book nav-icon"></i>
                        <span class="nav-label">Staff Directory</span>
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-divider" aria-hidden="true"></li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="/staff/profile/edit" class="nav-link">
                        <i class="fa fa-user-gear nav-icon"></i>
                        <span class="nav-label">Profile Settings</span>
                    </a>
                </li>

                <!-- Availability -->
                <li class="nav-item">
                    <a href="/staff/profile/status" class="nav-link">
                        <i class="fa fa-circle-dot nav-icon"></i>
                        <span class="nav-label">Availability</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Sidebar Footer — User Status -->
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar-sm">
                    <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=40"
                        alt="User avatar">
                </div>
                <div class="user-meta">
                    <span class="user-name">Dr. Daniel Tairo</span>
                    <span class="user-role">Supervisor</span>
                </div>
                <form method="POST" action="/logout">
                    <button type="submit" class="logout-btn" title="Logout" aria-label="Logout">
                        <i class="fa fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- Sidebar overlay (mobile) -->
    <div id="sidebar-overlay" class="sidebar-overlay" aria-hidden="true"></div>


    <!-- ============================================================
     MAIN WRAPPER
     ============================================================ -->
    <div class="main-wrapper" id="main-wrapper">

        <!-- ==========================================================
         TOPBAR / HEADER COMPONENT
         Split into: resources/views/components/topbar.blade.php
         ========================================================== -->
        <header class="topbar" id="topbar" role="banner">

            <!-- Left: sidebar toggle + page title -->
            <div class="topbar-left">
                <button id="sidebar-toggle" class="topbar-icon-btn" aria-label="Toggle sidebar" aria-expanded="false"
                    aria-controls="sidebar">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="page-title-group">
                    <h1 class="page-title">Dashboard</h1>
                    <span class="page-breadcrumb">Staff / Overview</span>
                </div>
            </div>

            <!-- Center: Search bar -->
            <div class="topbar-search-wrap">
                <div class="search-box">
                    <i class="fa fa-magnifying-glass search-icon"></i>
                    <input type="search" class="search-input" placeholder="Search staff, appointments..."
                        aria-label="Search">
                    <kbd class="search-kbd">⌘K</kbd>
                </div>
            </div>

            <!-- Right: actions -->
            <div class="topbar-right">

                <!-- Theme toggle -->
                <button id="theme-toggle" class="topbar-icon-btn" aria-label="Toggle dark/light mode"
                    title="Toggle theme">
                    <i class="fa fa-moon" id="theme-icon"></i>
                </button>

                <!-- Notifications dropdown -->
                <div class="dropdown" id="notifications-dropdown">
                    <button class="topbar-icon-btn dropdown-trigger" aria-haspopup="true" aria-expanded="false"
                        aria-label="Notifications">
                        <i class="fa fa-bell"></i>
                        <span class="notification-dot" aria-hidden="true"></span>
                    </button>

                    <div class="dropdown-panel notification-panel" role="menu" aria-label="Notifications">
                        <div class="dropdown-header">
                            <span class="dropdown-title">Notifications</span>
                            <a href="#" class="dropdown-action">Mark all read</a>
                        </div>
                        <ul class="notification-list">
                            <li class="notification-item unread" role="menuitem">
                                <div class="notif-icon-wrap notif-pending">
                                    <i class="fa fa-clock"></i>
                                </div>
                                <div class="notif-body">
                                    <p class="notif-text">New appointment request from <strong>Angel Mtumbuka</strong>
                                    </p>
                                    <span class="notif-time">2 minutes ago</span>
                                </div>
                            </li>
                            <li class="notification-item unread" role="menuitem">
                                <div class="notif-icon-wrap notif-approved">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="notif-body">
                                    <p class="notif-text">Your schedule for <strong>Week 3</strong> has been updated
                                    </p>
                                    <span class="notif-time">1 hour ago</span>
                                </div>
                            </li>
                            <li class="notification-item" role="menuitem">
                                <div class="notif-icon-wrap notif-info">
                                    <i class="fa fa-info"></i>
                                </div>
                                <div class="notif-body">
                                    <p class="notif-text">Appointment with <strong>Asante Katuli</strong> in 24 hours
                                    </p>
                                    <span class="notif-time">Yesterday</span>
                                </div>
                            </li>
                        </ul>
                        <div class="dropdown-footer">
                            <a href="/staff/notifications" class="dropdown-footer-link">View all notifications</a>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="dropdown" id="profile-dropdown">
                    <button class="profile-trigger dropdown-trigger" aria-haspopup="true" aria-expanded="false"
                        aria-label="Profile menu">
                        <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=36"
                            alt="Profile" class="profile-avatar">
                        <span class="profile-name-label">{{ Auth::user()->name }}</span>
                        <i class="fa fa-chevron-down profile-chevron"></i>
                    </button>

                    <div class="dropdown-panel profile-panel" role="menu" aria-label="Profile options">
                        <div class="profile-panel-header">
                            <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=48"
                                alt="Profile" class="profile-avatar-lg">
                            <div>
                                <p class="profile-panel-name">{{ Auth::user()->name }}</p>
                                <p class="profile-panel-role">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <ul class="profile-menu-list">
                            <li><a href="/staff/profile/edit" class="profile-menu-item" role="menuitem"><i
                                        class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="/staff/profile/status" class="profile-menu-item" role="menuitem"><i
                                        class="fa fa-circle-dot"></i> Availability</a></li>
                            <li><a href="/staff/schedule" class="profile-menu-item" role="menuitem"><i
                                        class="fa fa-calendar"></i> My Schedule</a></li>
                            <li class="profile-menu-divider"></li>
                            <li>
                                <form method="POST" action="/logout">
                                    <button type="submit" class="profile-menu-item profile-logout" role="menuitem">
                                        <i class="fa fa-right-from-bracket"></i> Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </header>


        <!-- ==========================================================
         MAIN CONTENT AREA
         ========================================================== -->
        <main class="content-area" id="content-area" role="main">

            @yield('content')

        </main>

        @include('layouts.footer')
