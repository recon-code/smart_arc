'use strict';

/* ============================================================
   1. THEME MANAGER
   ============================================================ */
const ThemeManager = {
    STORAGE_KEY: 'saass_theme',
    DARK: 'dark',
    LIGHT: 'light',

    current() {
        return document.documentElement.getAttribute('data-theme') || this.DARK;
    },

    apply(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(this.STORAGE_KEY, theme);
        this._updateIcons(theme);
    },

    _updateIcons(theme) {
        const iconClass = theme === this.DARK ? 'fa fa-moon' : 'fa fa-sun';
        document.querySelectorAll('[id^="theme-icon"]').forEach(el => {
            el.className = iconClass;
        });
    },

    toggle() {
        this.apply(this.current() === this.DARK ? this.LIGHT : this.DARK);
    },

    init() {
        let saved = this.DARK;
        try {
            saved = localStorage.getItem(this.STORAGE_KEY) || this.DARK;
        } catch (_) { /* ignore */ }
        this.apply(saved);

        document.querySelectorAll('[id^="theme-toggle"]').forEach(btn => {
            btn.addEventListener('click', () => this.toggle());
        });
    }
};
window.toggleTheme = () => ThemeManager.toggle();

/* ============================================================
   2. SIDEBAR MANAGER
   ============================================================ */
const SidebarManager = {
    MOBILE_CLASS: 'sidebar-open',
    COLLAPSE_CLASS: 'sidebar-collapsed',
    BREAKPOINT: 768,

    get sidebar() { return document.getElementById('sidebar'); },
    get overlay() { return document.getElementById('sidebar-overlay'); },
    get toggleBtn() { return document.getElementById('sidebar-toggle'); },
    get closeBtn() { return document.getElementById('sidebar-close'); },

    isMobile() {
        return window.innerWidth <= this.BREAKPOINT;
    },

    toggle() {
        if (this.isMobile()) {
            this._toggleMobile();
        } else {
            this._toggleCollapse();
        }
    },

    _toggleMobile() {
        const isOpen = document.body.classList.contains(this.MOBILE_CLASS);
        document.body.classList.toggle(this.MOBILE_CLASS, !isOpen);
        if (this.toggleBtn) {
            this.toggleBtn.setAttribute('aria-expanded', String(!isOpen));
        }
    },

    _toggleCollapse() {
        document.body.classList.toggle(this.COLLAPSE_CLASS);
    },

    closeMobile() {
        document.body.classList.remove(this.MOBILE_CLASS);
        if (this.toggleBtn) {
            this.toggleBtn.setAttribute('aria-expanded', 'false');
        }
    },

    _onResize() {
        if (!this.isMobile()) {
            document.body.classList.remove(this.MOBILE_CLASS);
        }
    },

    init() {
        const toggle = this.toggleBtn;
        const close = this.closeBtn;
        const overlay = this.overlay;

        if (toggle) toggle.addEventListener('click', () => this.toggle());
        if (close) close.addEventListener('click', () => this.closeMobile());
        if (overlay) overlay.addEventListener('click', () => this.closeMobile());

        window.addEventListener('resize', () => this._onResize(), { passive: true });
    }
};
window.toggleSidebar = () => SidebarManager.toggle();

/* ============================================================
   3. DROPDOWN MANAGER
   ============================================================ */
const DropdownManager = {
    init() {
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const trigger = dropdown.querySelector('.dropdown-trigger');
            const panel = dropdown.querySelector('.dropdown-panel');
            if (!trigger || !panel) return;

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = panel.classList.contains('open');
                this.closeAll();
                if (!isOpen) {
                    panel.classList.add('open');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });
    },

    closeAll() {
        document.querySelectorAll('.dropdown-panel.open').forEach(p => p.classList.remove('open'));
        document.querySelectorAll('.dropdown-trigger[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded', 'false'));
    }
};

/* ============================================================
   4. MODAL SYSTEM
   ============================================================ */
window.openModal = function (id) {
    const backdrop = document.getElementById(id);
    if (!backdrop) return;
    backdrop.classList.add('modal-open');
    document.body.style.overflow = 'hidden';
    const focusable = backdrop.querySelector('button, input, textarea, select, a[href]');
    if (focusable) setTimeout(() => focusable.focus(), 60);
};

window.closeModal = function (id) {
    const backdrop = document.getElementById(id);
    if (!backdrop) return;
    backdrop.classList.remove('modal-open');
    document.body.style.overflow = '';
};

function closeAllModals() {
    document.querySelectorAll('.modal-backdrop.modal-open').forEach(b => b.classList.remove('modal-open'));
    document.body.style.overflow = '';
}

/* ============================================================
   5. SCROLL REVEAL
   ============================================================ */
function initScrollReveal() {
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal-on-scroll').forEach(el => el.classList.add('revealed'));
        return;
    }
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
}

/* ============================================================
   6. SEARCH SHORTCUT (⌘K / Ctrl+K)
   ============================================================ */
function initSearchShortcut() {
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const search = document.querySelector('.search-input');
            if (search) { search.focus(); search.select(); }
        }
    });
}

/* ============================================================
   7. STATUS BANNER DISMISS (delegated)
   ============================================================ */
function initBannerDismiss() {
    document.addEventListener('click', (e) => {
        const closeBtn = e.target.closest('.status-banner-close');
        if (!closeBtn) return;
        const banner = closeBtn.closest('.status-banner');
        if (!banner) return;
        banner.style.transition = 'opacity 0.2s ease, max-height 0.3s ease, padding 0.3s ease, margin 0.3s ease';
        banner.style.opacity = '0';
        banner.style.maxHeight = '0';
        banner.style.overflow = 'hidden';
        banner.style.padding = '0';
        banner.style.margin = '0';
        setTimeout(() => {
            banner.remove();
        }, 350);
    });
}

/* ============================================================
   8. NAV SCROLL EFFECT (public pages)
   ============================================================ */
function updateNavScroll() {
    const nav = document.getElementById('pub-nav-landing');
    if (!nav) return;
    nav.classList.toggle('scrolled', window.scrollY > 40);
}
window.addEventListener('scroll', updateNavScroll, { passive: true });

/* ============================================================
   9. MOBILE MENU (public)
   ============================================================ */
window.closeMobileMenu = function (menuId) {
    const menu = document.getElementById(menuId);
    if (menu) menu.classList.remove('open');
};

/* ============================================================
   10. PASSWORD VISIBILITY TOGGLE
   ============================================================ */
window.togglePw = function (inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    const icon = btn.querySelector('i');
    if (icon) icon.className = isPassword ? 'fa fa-eye-slash' : 'fa fa-eye';
};

/* ============================================================
   11. PASSWORD STRENGTH METER
   ============================================================ */
window.updatePwStrength = function (val) {
    const wrap = document.getElementById('pw-strength-wrap');
    const label = document.getElementById('pw-strength-label');
    const bars = [
        document.getElementById('pwb1'),
        document.getElementById('pwb2'),
        document.getElementById('pwb3'),
        document.getElementById('pwb4')
    ];
    if (!wrap) return;
    if (!val) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'block';
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = ['weak', 'weak', 'medium', 'strong', 'strong'];
    const labels = ['Too short', 'Weak', 'Fair', 'Good', 'Strong'];
    const level = levels[score];
    bars.forEach((b, i) => {
        b.className = 'pw-bar';
        if (i < score) b.classList.add(level);
    });
    if (label) label.textContent = labels[score];
};

/* ============================================================
   12. ROLE SELECTOR — Login
   ============================================================ */
window.selectRole = function (el, role) {
    const container = el.closest('.role-tabs');
    if (container) {
        container.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
    }
    el.classList.add('active');
    const idLabel = document.getElementById('login-id-label');
    const idInput = document.getElementById('login-id');
    if (role === 'student') {
        if (idLabel) idLabel.innerHTML = 'Registration Number <span class="required-mark">*</span>';
        if (idInput) idInput.placeholder = 'e.g. IMC/BIT/2314470';
    } else if (role === 'staff') {
        if (idLabel) idLabel.innerHTML = 'Staff ID <span class="required-mark">*</span>';
        if (idInput) idInput.placeholder = 'e.g. IFM/STAFF/0042';
    } else {
        if (idLabel) idLabel.innerHTML = 'Email Address <span class="required-mark">*</span>';
        if (idInput) idInput.placeholder = 'admin@ifm.ac.tz';
    }
};

/* ============================================================
   13. ROLE SELECTOR — Register
   ============================================================ */
window.selectRegRole = function (el, role) {
    const container = el.closest('.role-tabs');
    if (container) {
        container.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
    }
    el.classList.add('active');
    const deptWrap = document.getElementById('reg-dept-wrap');
    const roleWrap = document.getElementById('reg-roletype-wrap');
    const idLabel = document.getElementById('reg-id-label');
    const idInput = document.getElementById('reg-id');
    const idHint = document.getElementById('reg-id-hint');
    if (role === 'staff') {
        if (deptWrap) deptWrap.style.display = 'flex';
        if (roleWrap) roleWrap.style.display = 'flex';
        if (idLabel) idLabel.innerHTML = 'Staff ID <span class="required-mark">*</span>';
        if (idInput) idInput.placeholder = 'e.g. IFM/STAFF/0042';
        if (idHint) idHint.textContent = 'Your official IFM staff identification number';
    } else {
        if (deptWrap) deptWrap.style.display = 'none';
        if (roleWrap) roleWrap.style.display = 'none';
        if (idLabel) idLabel.innerHTML = 'Registration Number <span class="required-mark">*</span>';
        if (idInput) idInput.placeholder = 'IMC/BIT/XXXXXXX';
        if (idHint) idHint.textContent = 'Format: IMC/BIT/XXXXXXX — as on your student ID card';
    }
};

/* ============================================================
   14. FAQ ACCORDION
   ============================================================ */
window.toggleFaq = function (btn) {
    const item = btn.closest('.faq-item');
    if (!item) return;
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
};

/* ============================================================
   15. CALENDAR SLOT → BOOKING MODAL (demo)
   ============================================================ */
function initCalendarSlotBooking() {
    document.addEventListener('click', (e) => {
        const slot = e.target.closest('.calendar-slot.slot-available, .slot-available');
        if (!slot) return;
        const time = slot.textContent.trim();
        const date = slot.closest('[data-date]')?.dataset.date || '';
        const timeInput = document.getElementById('book-time');
        const dateInput = document.getElementById('book-date');
        if (timeInput) timeInput.value = time;
        if (dateInput) dateInput.value = date;
        if (typeof window.openModal === 'function') {
            window.openModal('modal-booking');
        }
    });
}

/* ============================================================
   16. UPLOAD ZONE (drag & drop)
   ============================================================ */
function initUploadZone() {
    const zone = document.querySelector('.upload-zone');
    if (!zone) return;
    zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', () => {
        zone.classList.remove('drag-over');
    });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const files = e.dataTransfer?.files;
        if (!files || !files.length) return;
        if (typeof window.handleFiles === 'function') {
            window.handleFiles(files);
        } else {
            console.log('Dropped files:', files);
        }
    });
}

/* ============================================================
   17. AVAILABILITY OPTION CLICK
   ============================================================ */
function initAvailabilityOptions() {
    document.querySelectorAll('.avail-option').forEach(opt => {
        opt.addEventListener('click', () => {
            document.querySelectorAll('.avail-option').forEach(o => {
                o.classList.remove('selected');
                const chk = o.querySelector('.avail-check');
                if (chk) chk.remove();
            });
            opt.classList.add('selected');
            const icon = document.createElement('i');
            icon.className = 'fa fa-check avail-check';
            opt.appendChild(icon);
        });
    });
}

/* ============================================================
   18. PAGE BUTTONS (pagination demo)
   ============================================================ */
function initPaginationButtons() {
    document.querySelectorAll('.page-btn:not(:disabled)').forEach(btn => {
        btn.addEventListener('click', function () {
            if (this.querySelector('i')) return;
            document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

/* ============================================================
   19. BOOT — DOMContentLoaded
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
    // Theme
    ThemeManager.init();
    updateNavScroll();

    // Sidebar
    SidebarManager.init();

    // Dropdowns
    DropdownManager.init();

    // Global click — close dropdowns
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) DropdownManager.closeAll();
    });

    // Modal triggers (data-open-modal / data-close-modal)
    document.addEventListener('click', (e) => {
        const opener = e.target.closest('[data-open-modal]');
        if (opener) {
            e.stopPropagation();
            window.openModal(opener.dataset.openModal);
        }
        const closer = e.target.closest('[data-close-modal]');
        if (closer) {
            e.stopPropagation();
            window.closeModal(closer.dataset.closeModal);
        }
    });

    // Backdrop click closes modal
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) window.closeModal(backdrop.id);
        });
    });

    // ESC closes modals
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAllModals();
    });

    // Scroll reveal
    initScrollReveal();

    // Search shortcut
    initSearchShortcut();

    // Banner dismiss
    initBannerDismiss();

    // Calendar slot booking
    initCalendarSlotBooking();

    // Upload zone
    initUploadZone();

    // Availability options
    initAvailabilityOptions();

    // Pagination buttons
    initPaginationButtons();

    // Mobile burger (public pages)
    const burger = document.getElementById('burger-landing');
    const mobileMenu = document.getElementById('mobile-menu-landing');
    if (burger && mobileMenu) {
        burger.addEventListener('click', () => mobileMenu.classList.toggle('open'));
    }

    // Extra: demo page switcher (only if .demo-switcher exists)
    const demoButtons = document.querySelectorAll('.demo-btn');
    if (demoButtons.length) {
        demoButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const name = this.textContent.trim().toLowerCase();
                document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
                const target = document.getElementById('page-' + name);
                if (target) target.classList.add('active');
                demoButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                window.scrollTo(0, 0);
                if (name === 'landing') updateNavScroll();
            });
        });
    }
});