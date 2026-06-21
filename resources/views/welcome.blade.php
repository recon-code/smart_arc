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
                <span class="logo-text">SAASS</span>
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
                        <span class="profile-name-label">Dr. Tairo</span>
                        <i class="fa fa-chevron-down profile-chevron"></i>
                    </button>

                    <div class="dropdown-panel profile-panel" role="menu" aria-label="Profile options">
                        <div class="profile-panel-header">
                            <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=48"
                                alt="Profile" class="profile-avatar-lg">
                            <div>
                                <p class="profile-panel-name">Dr. Daniel Tairo</p>
                                <p class="profile-panel-role">Supervisor — IFM</p>
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

            <!-- Availability Status Banner (shown when staff is unavailable) -->
            <div class="status-banner status-banner-warning" id="availability-banner" role="alert" hidden>
                <i class="fa fa-triangle-exclamation"></i>
                <span>You are currently marked as <strong>Unavailable</strong>. Students cannot book
                    appointments.</span>
                <a href="/staff/profile/status" class="status-banner-action">Update status</a>
                <button class="status-banner-close" aria-label="Dismiss"><i class="fa fa-xmark"></i></button>
            </div>


            <!-- --------------------------------------------------------
             STAT CARDS ROW
             -------------------------------------------------------- -->
            <section class="stats-row" aria-label="Dashboard statistics">

                <div class="stat-card reveal-on-scroll">
                    <div class="stat-card-inner">
                        <div class="stat-icon-wrap stat-icon-pending">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <div class="stat-data">
                            <span class="stat-value">5</span>
                            <span class="stat-label">Pending Requests</span>
                        </div>
                    </div>
                    <a href="/staff/appointments?status=pending" class="stat-card-link">Review <i
                            class="fa fa-arrow-right"></i></a>
                </div>

                <div class="stat-card reveal-on-scroll">
                    <div class="stat-card-inner">
                        <div class="stat-icon-wrap stat-icon-approved">
                            <i class="fa fa-calendar-check"></i>
                        </div>
                        <div class="stat-data">
                            <span class="stat-value">12</span>
                            <span class="stat-label">Approved This Week</span>
                        </div>
                    </div>
                    <a href="/staff/appointments?status=approved" class="stat-card-link">View <i
                            class="fa fa-arrow-right"></i></a>
                </div>

                <div class="stat-card reveal-on-scroll">
                    <div class="stat-card-inner">
                        <div class="stat-icon-wrap stat-icon-today">
                            <i class="fa fa-sun"></i>
                        </div>
                        <div class="stat-data">
                            <span class="stat-value">3</span>
                            <span class="stat-label">Today's Appointments</span>
                        </div>
                    </div>
                    <a href="/staff/schedule" class="stat-card-link">Schedule <i class="fa fa-arrow-right"></i></a>
                </div>

                <div class="stat-card reveal-on-scroll">
                    <div class="stat-card-inner">
                        <div class="stat-icon-wrap stat-icon-denied">
                            <i class="fa fa-xmark-circle"></i>
                        </div>
                        <div class="stat-data">
                            <span class="stat-value">2</span>
                            <span class="stat-label">Denied This Week</span>
                        </div>
                    </div>
                    <a href="/staff/appointments?status=denied" class="stat-card-link">History <i
                            class="fa fa-arrow-right"></i></a>
                </div>

            </section>




            <!-- --------------------------------------------------------
             CONTENT GRID: Pending Requests + Chart Placeholder
             -------------------------------------------------------- -->
            <div class="content-grid">

                <!-- Pending Requests Table -->
                <section class="card reveal-on-scroll">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fa fa-inbox"></i> Pending Requests</h2>
                        <div class="card-header-actions">
                            <a href="/staff/appointments" class="btn btn-ghost btn-sm">View all</a>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Reason</th>
                                    <th>Requested</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-user">
                                            <img src="https://ui-avatars.com/api/?name=Angel+M&background=3b82f6&color=fff&size=32"
                                                class="table-avatar" alt="">
                                            <span>Angel Mtumbuka</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">Project review discussion</td>
                                    <td class="text-muted">Mon, Jun 23 — 10:00 AM</td>
                                    <td><span class="badge badge-pending">Pending</span></td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn btn-sm btn-primary"
                                                onclick="openModal('approve-modal')">Approve</button>
                                            <button class="btn btn-sm btn-ghost"
                                                onclick="openModal('deny-modal')">Deny</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-user">
                                            <img src="https://ui-avatars.com/api/?name=Asante+K&background=6366f1&color=fff&size=32"
                                                class="table-avatar" alt="">
                                            <span>Asante Katuli</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">Final year project guidance</td>
                                    <td class="text-muted">Tue, Jun 24 — 2:00 PM</td>
                                    <td><span class="badge badge-pending">Pending</span></td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn btn-sm btn-primary"
                                                onclick="openModal('approve-modal')">Approve</button>
                                            <button class="btn btn-sm btn-ghost"
                                                onclick="openModal('deny-modal')">Deny</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-user">
                                            <img src="https://ui-avatars.com/api/?name=Yaqin+K&background=10b981&color=fff&size=32"
                                                class="table-avatar" alt="">
                                            <span>Yaqin Kakomile</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">Loan application clarification</td>
                                    <td class="text-muted">Wed, Jun 25 — 9:30 AM</td>
                                    <td><span class="badge badge-pending">Pending</span></td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn btn-sm btn-primary"
                                                onclick="openModal('approve-modal')">Approve</button>
                                            <button class="btn btn-sm btn-ghost"
                                                onclick="openModal('deny-modal')">Deny</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Chart Placeholder + Quick Info -->
                <aside class="card-stack">

                    <!-- Chart placeholder -->
                    <div class="card reveal-on-scroll">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa fa-chart-pie"></i> Appointments This Week</h2>
                        </div>
                        <div class="chart-placeholder" aria-label="Appointment status chart">
                            <!-- Inline SVG donut chart (no library) -->
                            <svg viewBox="0 0 120 120" class="donut-chart" aria-hidden="true">
                                <!-- Background circle -->
                                <circle cx="60" cy="60" r="50" fill="none" stroke="var(--border)"
                                    stroke-width="18" />
                                <!-- Approved segment -->
                                <circle cx="60" cy="60" r="50" fill="none"
                                    stroke="var(--color-approved)" stroke-width="18" stroke-dasharray="63 314"
                                    stroke-dashoffset="0" transform="rotate(-90 60 60)" />
                                <!-- Pending segment -->
                                <circle cx="60" cy="60" r="50" fill="none"
                                    stroke="var(--color-pending)" stroke-width="18" stroke-dasharray="31 314"
                                    stroke-dashoffset="-63" transform="rotate(-90 60 60)" />
                                <!-- Denied segment -->
                                <circle cx="60" cy="60" r="50" fill="none"
                                    stroke="var(--color-denied)" stroke-width="18" stroke-dasharray="13 314"
                                    stroke-dashoffset="-94" transform="rotate(-90 60 60)" />
                                <!-- Center text -->
                                <text x="60" y="56" text-anchor="middle" class="donut-label-val"
                                    fill="var(--text-primary)">19</text>
                                <text x="60" y="68" text-anchor="middle" class="donut-label-sub"
                                    fill="var(--text-muted)">total</text>
                            </svg>

                            <ul class="chart-legend">
                                <li><span class="legend-dot" style="background: var(--color-approved)"></span>
                                    Approved (12)</li>
                                <li><span class="legend-dot" style="background: var(--color-pending)"></span> Pending
                                    (5)</li>
                                <li><span class="legend-dot" style="background: var(--color-denied)"></span> Denied
                                    (2)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Upcoming today -->
                    <div class="card reveal-on-scroll">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa fa-calendar-day"></i> Today</h2>
                            <span class="card-meta">Sunday, June 21</span>
                        </div>
                        <ul class="today-list">
                            <li class="today-item">
                                <span class="today-time">10:00</span>
                                <div class="today-detail">
                                    <span class="today-name">DB Design Lecture</span>
                                    <span class="today-tag today-tag-lecture">Lecture</span>
                                </div>
                            </li>
                            <li class="today-item">
                                <span class="today-time">14:00</span>
                                <div class="today-detail">
                                    <span class="today-name">Maria Mwinami — Project review</span>
                                    <span class="today-tag today-tag-apt">Appointment</span>
                                </div>
                            </li>
                            <li class="today-item">
                                <span class="today-time">16:30</span>
                                <div class="today-detail">
                                    <span class="today-name">Faculty meeting</span>
                                    <span class="today-tag today-tag-meeting">Meeting</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                </aside>
            </div>

            <!-- ================================================================
         13. STAFF CARD (Directory) ★ NEW
         ================================================================ -->
            <section id="staffcard" class="ref-section">
                {{-- <div class="ref-section-header">
                    <span class="ref-section-tag">Section 13 <span style="color: var(--color-approved);">★
                            NEW</span></span>
                    <h2 class="ref-section-title">Staff Card — Directory</h2>
                    <p class="ref-section-desc">Used in <span class="ref-code">/student/staff</span>. Grid layout via
                        <span class="ref-code">.staff-grid</span>. Add CSS Section 21 to <span
                            class="ref-code">app.css</span>.
                    </p>
                </div> --}}
                <div class="staff-grid">
                    <div class="staff-card">
                        <div class="staff-card-top">
                            <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=52"
                                class="staff-avatar" alt="">
                            <div class="staff-info">
                                <p class="staff-name">Dr. Daniel Tairo</p>
                                <p class="staff-role">Supervisor</p>
                                <p class="staff-dept">Faculty of Computing &amp; Mathematics</p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                            <div class="staff-card-meta"><i class="fa fa-building"></i> Block C, Room 204</div>
                            <div class="staff-card-meta staff-status-available"><i class="fa fa-circle-dot"></i>
                                Available</div>
                        </div>
                        <div class="staff-card-footer">
                            <span class="badge badge-approved">Available</span>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-calendar-plus"></i> Book</button>
                        </div>
                    </div>

                    <div class="staff-card">
                        <div class="staff-card-top">
                            <img src="https://ui-avatars.com/api/?name=Maria+M&background=6366f1&color=fff&size=52"
                                class="staff-avatar" alt="">
                            <div class="staff-info">
                                <p class="staff-name">Ms. Maria Mwinami</p>
                                <p class="staff-role">Registrar</p>
                                <p class="staff-dept">Student Affairs</p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                            <div class="staff-card-meta"><i class="fa fa-building"></i> Admin Block, Room 101</div>
                            <div class="staff-card-meta staff-status-leave"><i class="fa fa-circle-dot"></i> On Leave
                                until Jun 28</div>
                        </div>
                        <div class="staff-card-footer">
                            <span class="badge badge-pending">On Leave</span>
                            <button class="btn btn-sm btn-ghost" disabled>Unavailable</button>
                        </div>
                    </div>

                    <div class="staff-card">
                        <div class="staff-card-top">
                            <img src="https://ui-avatars.com/api/?name=Alhaji+H&background=ef4444&color=fff&size=52"
                                class="staff-avatar" alt="">
                            <div class="staff-info">
                                <p class="staff-name">Mr. Alhaji Hassan</p>
                                <p class="staff-role">Loan Officer</p>
                                <p class="staff-dept">Finance Department</p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                            <div class="staff-card-meta"><i class="fa fa-building"></i> Finance Block, Room 12</div>
                            <div class="staff-card-meta staff-status-unavailable"><i class="fa fa-circle-dot"></i>
                                Unavailable today</div>
                        </div>
                        <div class="staff-card-footer">
                            <span class="badge badge-denied">Unavailable</span>
                            <button class="btn btn-sm btn-ghost" disabled>Cannot Book</button>
                        </div>
                    </div>
                </div>
            </section>


            <!-- ================================================================
         14. APPOINTMENT CARD ★ NEW
         ================================================================ -->
            <section id="aptcard" class="ref-section">
                <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <!-- Pending -->
                    <div class="apt-card">
                        <div class="apt-card-icon stat-icon-pending"><i class="fa fa-hourglass-half"></i></div>
                        <div class="apt-body">
                            <span class="apt-ref">APT-20260621-0042</span>
                            <p class="apt-name">Dr. Daniel Tairo</p>
                            <p class="apt-reason">Project review discussion — final year thesis methodology</p>
                            <div class="apt-meta">
                                <div class="apt-meta-item"><i class="fa fa-calendar"></i> Mon, Jun 23, 2026</div>
                                <div class="apt-meta-item"><i class="fa fa-clock"></i> 10:00 – 10:30 AM</div>
                                <div class="apt-meta-item"><i class="fa fa-building"></i> Block C, Room 204</div>
                            </div>
                        </div>
                        <div class="apt-actions">
                            <span class="badge badge-pending">Pending</span>
                            <button class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>

                    <!-- Approved -->
                    <div class="apt-card">
                        <div class="apt-card-icon stat-icon-approved"><i class="fa fa-calendar-check"></i></div>
                        <div class="apt-body">
                            <span class="apt-ref">APT-20260621-0041</span>
                            <p class="apt-name">Ms. Maria Mwinami</p>
                            <p class="apt-reason">Transcript request and clearance form guidance</p>
                            <div class="apt-meta">
                                <div class="apt-meta-item"><i class="fa fa-calendar"></i> Wed, Jun 25, 2026</div>
                                <div class="apt-meta-item"><i class="fa fa-clock"></i> 2:00 – 2:30 PM</div>
                                <div class="apt-meta-item"><i class="fa fa-building"></i> Admin Block, Room 101</div>
                            </div>
                        </div>
                        <div class="apt-actions">
                            <span class="badge badge-approved">Approved</span>
                            <button class="btn btn-sm btn-ghost">View</button>
                        </div>
                    </div>

                    <!-- Denied -->
                    <div class="apt-card" style="opacity: 0.8;">
                        <div class="apt-card-icon stat-icon-denied"><i class="fa fa-xmark-circle"></i></div>
                        <div class="apt-body">
                            <span class="apt-ref">APT-20260618-0040</span>
                            <p class="apt-name">Mr. Alhaji Hassan</p>
                            <p class="apt-reason">Student loan application status inquiry</p>
                            <div class="apt-meta">
                                <div class="apt-meta-item"><i class="fa fa-calendar"></i> Jun 20, 2026</div>
                                <div class="apt-meta-item" style="color: var(--color-denied);"><i
                                        class="fa fa-message"></i> "Please consult with the loan department first."
                                </div>
                            </div>
                        </div>
                        <div class="apt-actions">
                            <span class="badge badge-denied">Denied</span>
                            <button class="btn btn-sm btn-primary">Rebook</button>
                        </div>
                    </div>
                </div>
            </section>


            <!-- --------------------------------------------------------
             BUTTON STYLE SHOWCASE (Component library reference)
             -------------------------------------------------------- -->
            <section class="card reveal-on-scroll" style="margin-top: var(--space-6);">
                <div class="card-header">
                    <h2 class="card-title"><i class="fa fa-palette"></i> Button Components</h2>
                </div>
                <div class="btn-showcase">
                    <button class="btn btn-primary"><i class="fa fa-check"></i> Approve</button>
                    <button class="btn btn-secondary"><i class="fa fa-plus"></i> Add Event</button>
                    <button class="btn btn-danger"><i class="fa fa-xmark"></i> Deny</button>
                    <button class="btn btn-ghost"><i class="fa fa-eye"></i> Preview</button>
                    <button class="btn btn-outline"><i class="fa fa-file-export"></i> Export</button>
                </div>
            </section>

        </main>


        <!-- ==========================================================
         FOOTER COMPONENT
         Split into: resources/views/components/footer.blade.php
         ========================================================== -->
        <footer class="app-footer" role="contentinfo">
            <span>SAASS &mdash; Smart Academic Appointment System</span>
            <span class="footer-divider" aria-hidden="true">&bull;</span>
            <span>IFM &mdash; BIT Year 3 &mdash; 2025/2026</span>
            <span class="footer-divider" aria-hidden="true">&bull;</span>
            <span>v1.0</span>
        </footer>

    </div><!-- end .main-wrapper -->


    <!-- ============================================================
     MODAL: Approve Appointment
     ============================================================ -->
    <div class="modal-backdrop" id="approve-modal" role="dialog" aria-modal="true" aria-labelledby="approve-title"
        hidden>
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="approve-title"><i class="fa fa-check-circle"></i> Approve Appointment
                </h3>
                <button class="modal-close" onclick="closeModal('approve-modal')" aria-label="Close modal"><i
                        class="fa fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-info-row">
                    <span class="modal-info-label">Student</span>
                    <span class="modal-info-value">Angel Barnaba Mtumbuka</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Requested Time</span>
                    <span class="modal-info-value">Mon, Jun 23 — 10:00 AM</span>
                </div>
                <div class="form-group">
                    <label class="form-label" for="approve-note">Note to student (optional)</label>
                    <textarea id="approve-note" class="form-textarea" rows="3"
                        placeholder="e.g. See you then — bring your project file."></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="adj-start">Adjust start time</label>
                        <input type="time" id="adj-start" class="form-input" value="10:00">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="adj-end">Adjust end time</label>
                        <input type="time" id="adj-end" class="form-input" value="10:30">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" onclick="closeModal('approve-modal')">Cancel</button>
                <button class="btn btn-primary"><i class="fa fa-check"></i> Confirm Approval</button>
            </div>
        </div>
    </div>

    <!-- ============================================================
     MODAL: Deny Appointment
     ============================================================ -->
    <div class="modal-backdrop" id="deny-modal" role="dialog" aria-modal="true" aria-labelledby="deny-title"
        hidden>
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title modal-title-danger" id="deny-title"><i class="fa fa-xmark-circle"></i> Deny
                    Appointment</h3>
                <button class="modal-close" onclick="closeModal('deny-modal')" aria-label="Close modal"><i
                        class="fa fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label required" for="deny-reason">Reason for denial <span
                            class="required-mark">*</span></label>
                    <textarea id="deny-reason" class="form-textarea" rows="4"
                        placeholder="e.g. Conflict with faculty meeting. Please resubmit for next week."></textarea>
                    <span class="form-hint">This message will be sent to the student via email.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" onclick="closeModal('deny-modal')">Cancel</button>
                <button class="btn btn-danger"><i class="fa fa-xmark"></i> Confirm Denial</button>
            </div>
        </div>
    </div>


</body>

</html>
