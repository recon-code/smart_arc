@extends('layouts.main')
@section('title', 'Home')

@section('content')
    <!-- ================================================================
                         PAGE 1: LANDING (resources/views/welcome.blade.php)
                         Route: GET /   → WelcomeController@index
                         ================================================================ -->




    <!-- HERO -->
    <section class="hero" id="hero-section">
        <div class="hero-grid-bg"></div>
        <div class="hero-inner">
            <!-- Left copy -->
            <div class="anim-up">
                <div class="hero-eyebrow"><i class="fa fa-circle-check"></i> IFM — BIT Year 3 Project 2025/2026</div>
                <h1 class="hero-title">
                    Book your lecturer.<br>
                    <span>Skip the waiting.</span><br>
                    Get answers faster.
                </h1>
                <p class="hero-desc">
                    SAASS replaces the chaos of office-door queuing with a structured, digital appointment system for
                    students, lecturers, and staff at the Institute of Finance Management.
                </p>
                <div class="hero-cta">
                    <a href="#" class="btn btn-white btn-xl" onclick="showPage('register'); return false;"><i
                            class="fa fa-calendar-plus"></i> Book Appointment</a>
                    <a href="/login" class="btn btn-outline-white btn-xl"><i class="fa fa-right-to-bracket"></i> Sign
                        In</a>
                </div>
                <div class="hero-trust">
                    <div class="hero-trust-item"><i class="fa fa-check-circle"></i> No walk-in queues</div>
                    <div class="hero-trust-divider"></div>
                    <div class="hero-trust-item"><i class="fa fa-check-circle"></i> Real-time slot availability</div>
                    <div class="hero-trust-divider"></div>
                    <div class="hero-trust-item"><i class="fa fa-check-circle"></i> Email notifications</div>
                </div>
            </div>

            <!-- Right visual mockup -->
            <div class="hero-visual anim-up-2">
                <div class="hero-card">
                    <p class="hero-card-title"><i class="fa fa-calendar-day"></i> &nbsp; Today's Schedule — Dr. Tairo
                    </p>
                    <div class="hero-apt-item">
                        <span class="hero-apt-dot" style="background:#10B981;"></span>
                        <div class="hero-apt-info">
                            <p class="hero-apt-name">Angel Mtumbuka</p>
                            <p class="hero-apt-time">09:00 – 09:30 &nbsp;·&nbsp; Thesis review</p>
                        </div>
                        <span class="hero-apt-badge"
                            style="background:rgba(16,185,129,0.15);color:#10B981;">Confirmed</span>
                    </div>
                    <div class="hero-apt-item">
                        <span class="hero-apt-dot" style="background:#F59E0B;"></span>
                        <div class="hero-apt-info">
                            <p class="hero-apt-name">Asante Katuli</p>
                            <p class="hero-apt-time">10:00 – 10:30 &nbsp;·&nbsp; Project guidance</p>
                        </div>
                        <span class="hero-apt-badge" style="background:rgba(245,158,11,0.15);color:#F59E0B;">Pending</span>
                    </div>
                    <div class="hero-apt-item">
                        <span class="hero-apt-dot" style="background:#3B82F6;"></span>
                        <div class="hero-apt-info">
                            <p class="hero-apt-name">Maria Mwinami</p>
                            <p class="hero-apt-time">14:00 – 14:30 &nbsp;·&nbsp; Methodology check</p>
                        </div>
                        <span class="hero-apt-badge" style="background:rgba(59,130,246,0.15);color:#3B82F6;">Upcoming</span>
                    </div>
                </div>
                <div class="hero-stats-row">
                    <div class="hero-stat">
                        <span class="hero-stat-val">342</span>
                        <span class="hero-stat-lbl">Active users</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-val">98%</span>
                        <span class="hero-stat-lbl">On-time rate</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-val">38</span>
                        <span class="hero-stat-lbl">Staff members</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wave -->
    <div class="wave-divider">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            style="height:60px; width:100%;">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="var(--bg-base)" />
        </svg>
    </div>

    <!-- FEATURES -->
    <section class="section" id="features-section">
        <div class="section-inner">
            <div class="section-header section-header-centered">
                <span class="section-eyebrow">Features</span>
                <h2 class="section-title">Everything you need, nothing you don't</h2>
                <p class="section-desc">Built specifically for IFM's workflow — not a generic booking tool bolted on.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon fi-blue"><i class="fa fa-calendar-check"></i></div>
                    <p class="feature-title">Smart Slot Booking</p>
                    <p class="feature-desc">Students browse real-time available consultation slots and book in seconds.
                        No double-bookings, ever — enforced at the database level.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon fi-green"><i class="fa fa-envelope-circle-check"></i></div>
                    <p class="feature-title">Email Notifications</p>
                    <p class="feature-desc">Automatic emails on every status change — request submitted, approved,
                        denied, cancelled. Plus 24-hour reminders before the appointment.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon fi-yellow"><i class="fa fa-file-pdf"></i></div>
                    <p class="feature-title">Timetable Upload</p>
                    <p class="feature-desc">Staff upload their PDF timetable and add events to their calendar. Students
                        see blocked slots — no booking conflicts with existing commitments.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon fi-purple"><i class="fa fa-circle-dot"></i></div>
                    <p class="feature-title">Live Availability Status</p>
                    <p class="feature-desc">Staff set their general status: Available, Unavailable, On Leave, or In
                        Meetings. Students see this instantly before attempting to book.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon fi-teal"><i class="fa fa-users-gear"></i></div>
                    <p class="feature-title">Multi-Role System</p>
                    <p class="feature-desc">Supports Students, Lecturers, Registrars, Wardens, Loan Officers,
                        Principals and Administrators — all from one unified platform.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon fi-red"><i class="fa fa-chart-pie"></i></div>
                    <p class="feature-title">Admin Analytics</p>
                    <p class="feature-desc">Administrators get a real-time overview: total appointments, status
                        breakdowns, top staff, and exportable PDF/CSV reports.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="section hiw-bg" id="hiw-section">
        <div class="section-inner">
            <div class="section-header section-header-centered">
                <span class="section-eyebrow">How it works</span>
                <h2 class="section-title">From request to meeting in 4 steps</h2>
                <p class="section-desc">No phone calls, no walking to offices to find an empty room, no guessing if the
                    lecturer is even in today.</p>
            </div>
            <div class="steps-grid">
                <div class="step">
                    <div class="step-num">1</div>
                    <p class="step-title">Browse Staff Directory</p>
                    <p class="step-desc">Search by name, department, or role. See real-time availability status before
                        you click.</p>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <p class="step-title">Pick a Slot</p>
                    <p class="step-desc">View the staff member's calendar — green slots are open. Click one to pre-fill
                        your request form.</p>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <p class="step-title">Submit Your Request</p>
                    <p class="step-desc">Write your reason, submit. The slot is locked as Pending. Staff receives an
                        email instantly.</p>
                </div>
                <div class="step">
                    <div class="step-num">4</div>
                    <p class="step-title">Get Notified</p>
                    <p class="step-desc">Staff approves or denies with a reason. You get an email with the final
                        details and a reminder 24 hours before.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS BANNER -->
    <div class="stats-banner">
        <div class="stats-banner-inner">
            <div class="stats-banner-grid">
                <div>
                    <p class="stat-big-val">342<span>+</span></p>
                    <p class="stat-big-lbl">Registered users</p>
                </div>
                <div>
                    <p class="stat-big-val">1,200<span>+</span></p>
                    <p class="stat-big-lbl">Appointments booked</p>
                </div>
                <div>
                    <p class="stat-big-val">38</p>
                    <p class="stat-big-lbl">Active staff members</p>
                </div>
                <div>
                    <p class="stat-big-val">98<span>%</span></p>
                    <p class="stat-big-lbl">Appointments fulfilled on time</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ROLES -->
    <section class="section" id="roles-section">
        <div class="section-inner">
            <div class="section-header section-header-centered">
                <span class="section-eyebrow">Who it's for</span>
                <h2 class="section-title">One system, three portals</h2>
                <p class="section-desc">Every user type gets a purpose-built dashboard designed around their specific
                    workflow.</p>
            </div>
            <div class="roles-grid">
                <div class="role-card">
                    <div class="role-card-header student">
                        <div class="role-header-icon"><i class="fa fa-user-graduate"></i></div>
                        <p class="role-header-title">Students</p>
                        <p class="role-header-desc">Browse staff, book slots, track status</p>
                    </div>
                    <div class="role-card-body">
                        <ul class="role-features">
                            <li class="role-feature"><i class="fa fa-check"></i> Search staff directory by name or
                                department</li>
                            <li class="role-feature"><i class="fa fa-check"></i> View real-time calendar availability
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Submit appointment requests with
                                reason</li>
                            <li class="role-feature"><i class="fa fa-check"></i> Track pending, approved, and denied
                                requests</li>
                            <li class="role-feature"><i class="fa fa-check"></i> Cancel and rebook at any time</li>
                            <li class="role-feature"><i class="fa fa-check"></i> Receive email confirmations and
                                reminders</li>
                        </ul>
                    </div>
                    <div class="role-card-footer">
                        <a href="#" class="btn btn-primary btn-sm" onclick="showPage('register'); return false;"
                            style="width:100%; justify-content:center;"><i class="fa fa-user-plus"></i> Register as
                            Student</a>
                    </div>
                </div>
                <div class="role-card">
                    <div class="role-card-header staff">
                        <div class="role-header-icon"><i class="fa fa-user-tie"></i></div>
                        <p class="role-header-title">Staff Members</p>
                        <p class="role-header-desc">Manage your schedule & requests</p>
                    </div>
                    <div class="role-card-body">
                        <ul class="role-features">
                            <li class="role-feature"><i class="fa fa-check"></i> Upload PDF timetable & block events
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Define open consultation time slots
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Approve or deny requests with notes
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Adjust appointment times on approval
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Set general availability status
                                instantly</li>
                            <li class="role-feature"><i class="fa fa-check"></i> View today's schedule at a glance
                            </li>
                        </ul>
                    </div>
                    <div class="role-card-footer">
                        <a href="#" class="btn btn-sm" onclick="showPage('login'); return false;"
                            style="width:100%; justify-content:center; background:#065f46; color:#fff; border-color:#065f46;"><i
                                class="fa fa-right-to-bracket"></i> Staff Sign In</a>
                    </div>
                </div>
                <div class="role-card">
                    <div class="role-card-header admin">
                        <div class="role-header-icon"><i class="fa fa-shield-halved"></i></div>
                        <p class="role-header-title">Administrators</p>
                        <p class="role-header-desc">Full system oversight & control</p>
                    </div>
                    <div class="role-card-body">
                        <ul class="role-features">
                            <li class="role-feature"><i class="fa fa-check"></i> Create, edit, and deactivate user
                                accounts</li>
                            <li class="role-feature"><i class="fa fa-check"></i> Assign and change user role types
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Monitor all system appointments</li>
                            <li class="role-feature"><i class="fa fa-check"></i> View real-time analytics dashboard
                            </li>
                            <li class="role-feature"><i class="fa fa-check"></i> Export PDF and CSV reports</li>
                            <li class="role-feature"><i class="fa fa-check"></i> Reset passwords and view login logs
                            </li>
                        </ul>
                    </div>
                    <div class="role-card-footer">
                        <a href="#" class="btn btn-sm" onclick="showPage('login'); return false;"
                            style="width:100%; justify-content:center; background:#9a3412; color:#fff; border-color:#9a3412;"><i
                                class="fa fa-right-to-bracket"></i> Admin Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="section hiw-bg">
        <div class="section-inner">
            <div class="section-header section-header-centered">
                <span class="section-eyebrow">Testimonials</span>
                <h2 class="section-title">What the IFM community says</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div>
                    <p class="testimonial-quote">I used to walk to Block C three times before catching Dr. Tairo in his
                        office. Now I book in 30 seconds and show up at the right time.</p>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Angel+M&background=1e3a5f&color=fff&size=40"
                            class="testimonial-avatar" alt="">
                        <div>
                            <p class="testimonial-name">Angel Mtumbuka</p>
                            <p class="testimonial-role">BIT Year 3 Student</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div>
                    <p class="testimonial-quote">My unannounced visitors dropped to zero. I can plan my week around
                        confirmed appointments. The deny-with-reason feature saves a lot of awkward conversations.</p>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Dr+Tairo&background=1e3a5f&color=fff&size=40"
                            class="testimonial-avatar" alt="">
                        <div>
                            <p class="testimonial-name">Dr. Daniel Tairo</p>
                            <p class="testimonial-role">Project Supervisor, IFM</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star-half-stroke"></i>
                    </div>
                    <p class="testimonial-quote">Managing 300 student accounts is straightforward. The analytics show
                        me exactly which departments are busiest and where bottlenecks happen.</p>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Admin+IFM&background=9a3412&color=fff&size=40"
                            class="testimonial-avatar" alt="">
                        <div>
                            <p class="testimonial-name">IFM Administrator</p>
                            <p class="testimonial-role">System Admin, IT Dept.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA BAND -->
    <section class="cta-band">
        <div class="cta-band-inner">
            <h2 class="cta-band-title">Ready to end the office queue?</h2>
            <p class="cta-band-desc">Join students and staff at IFM who've already switched to smarter scheduling. It
                takes 60 seconds to set up your account.</p>
            <div class="cta-band-btns">
                <a href="#" class="btn btn-white btn-xl" onclick="showPage('register'); return false;"><i
                        class="fa fa-user-plus"></i> Create Account</a>
                <a href="#" class="btn btn-outline-white btn-lg" onclick="showPage('contact'); return false;"><i
                        class="fa fa-envelope"></i> Contact Us</a>
            </div>
        </div>
    </section>
@endsection
