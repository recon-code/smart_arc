@extends('layouts.mainer')
@section('title', 'Home')

@section('content')

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
            <a href="/staff/appointments?status=pending" class="stat-card-link">Review <i class="fa fa-arrow-right"></i></a>
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
            <a href="/staff/appointments?status=approved" class="stat-card-link">View <i class="fa fa-arrow-right"></i></a>
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
            <a href="/staff/appointments?status=denied" class="stat-card-link">History <i class="fa fa-arrow-right"></i></a>
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
                                    <button class="btn btn-sm btn-ghost" onclick="openModal('deny-modal')">Deny</button>
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
                                    <button class="btn btn-sm btn-ghost" onclick="openModal('deny-modal')">Deny</button>
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
                                    <button class="btn btn-sm btn-ghost" onclick="openModal('deny-modal')">Deny</button>
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
                        <circle cx="60" cy="60" r="50" fill="none" stroke="var(--color-approved)"
                            stroke-width="18" stroke-dasharray="63 314" stroke-dashoffset="0"
                            transform="rotate(-90 60 60)" />
                        <!-- Pending segment -->
                        <circle cx="60" cy="60" r="50" fill="none" stroke="var(--color-pending)"
                            stroke-width="18" stroke-dasharray="31 314" stroke-dashoffset="-63"
                            transform="rotate(-90 60 60)" />
                        <!-- Denied segment -->
                        <circle cx="60" cy="60" r="50" fill="none" stroke="var(--color-denied)"
                            stroke-width="18" stroke-dasharray="13 314" stroke-dashoffset="-94"
                            transform="rotate(-90 60 60)" />
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
                        <div class="apt-meta-item" style="color: var(--color-denied);"><i class="fa fa-message"></i>
                            "Please consult with the loan department first."
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

@endsection
