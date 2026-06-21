/**
 * SAASS — Dashboard Application JavaScript
 * Smart Academic Appointment & Scheduling System
 * Stack: Laravel 13 + TailwindCSS + Vanilla JS (ES6, no jQuery)
 *
 * Modules:
 *   1. Theme toggle (dark/light, localStorage persistence)
 *   2. Sidebar toggle (mobile drawer + desktop collapse)
 *   3. Dropdown menus (profile + notifications)
 *   4. Modal system (open/close reusable)
 *   5. Click-outside handler
 *   6. Scroll reveal animation
 *   7. Search (keyboard shortcut ⌘K / Ctrl+K)
 *   8. Status banner dismiss
 */

'use strict';

/* ============================================================
   1. THEME TOGGLE
   Persists user preference in localStorage.
   Toggles [data-theme] on <html>.
   ============================================================ */



const ThemeManager = {
    STORAGE_KEY: 'saass_theme',
    DARK:  'dark',
    LIGHT: 'light',

    /** Get current theme from DOM */
    current() {
        return document.documentElement.getAttribute('data-theme') || this.DARK;
    },

    /** Apply a theme to the DOM and persist it */
    apply(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(this.STORAGE_KEY, theme);
        this._updateIcon(theme);
    },

    /** Toggle between dark and light */
    toggle() {
        const next = this.current() === this.DARK ? this.LIGHT : this.DARK;
        this.apply(next);
    },

    /** Update the icon in the topbar */
    _updateIcon(theme) {
        const icon = document.getElementById('theme-icon');
        if (!icon) return;
        icon.className = theme === this.DARK ? 'fa fa-moon' : 'fa fa-sun';
    },

    /** Initialize — read from localStorage or default to dark */
    init() {
        const saved = localStorage.getItem(this.STORAGE_KEY) || this.DARK;
        this.apply(saved);

        const btn = document.getElementById('theme-toggle');
        if (btn) {
            btn.addEventListener('click', () => this.toggle());
        }
    }
};


/* ============================================================
   2. SIDEBAR TOGGLE
   - Mobile: drawer open/close via body class
   - Desktop: collapse (icon-only) via body class
   ============================================================ */

const SidebarManager = {
    MOBILE_CLASS:    'sidebar-open',
    COLLAPSE_CLASS:  'sidebar-collapsed',
    MOBILE_BREAKPOINT: 768,

    get sidebar()        { return document.getElementById('sidebar'); },
    get overlay()        { return document.getElementById('sidebar-overlay'); },
    get toggleBtn()      { return document.getElementById('sidebar-toggle'); },
    get closeBtn()       { return document.getElementById('sidebar-close'); },
    get mainWrapper()    { return document.getElementById('main-wrapper'); },

    isMobile() {
        return window.innerWidth <= this.MOBILE_BREAKPOINT;
    },

    /** Toggle sidebar based on current viewport */
    toggle() {
        if (this.isMobile()) {
            this._toggleMobile();
        } else {
            this._toggleCollapse();
        }
    },

    /** Mobile: slide drawer in/out */
    _toggleMobile() {
        const isOpen = document.body.classList.contains(this.MOBILE_CLASS);
        document.body.classList.toggle(this.MOBILE_CLASS, !isOpen);

        const btn = this.toggleBtn;
        if (btn) btn.setAttribute('aria-expanded', String(!isOpen));
    },

    /** Desktop: collapse to icon-only rail */
    _toggleCollapse() {
        document.body.classList.toggle(this.COLLAPSE_CLASS);
    },

    /** Close mobile drawer (overlay click, close btn) */
    closeMobile() {
        document.body.classList.remove(this.MOBILE_CLASS);
        const btn = this.toggleBtn;
        if (btn) btn.setAttribute('aria-expanded', 'false');
    },

    /** Close desktop sidebar if window resizes to mobile */
    _onResize() {
        if (!this.isMobile()) {
            document.body.classList.remove(this.MOBILE_CLASS);
        }
    },

    init() {
        const toggle  = this.toggleBtn;
        const close   = this.closeBtn;
        const overlay = this.overlay;

        if (toggle)  toggle.addEventListener('click', () => this.toggle());
        if (close)   close.addEventListener('click', () => this.closeMobile());
        if (overlay) overlay.addEventListener('click', () => this.closeMobile());

        window.addEventListener('resize', () => this._onResize(), { passive: true });
    }
};

// Expose for use inline (e.g., onclick attributes)
function toggleSidebar() { SidebarManager.toggle(); }


/* ============================================================
   3. DROPDOWN MENUS
   Supports multiple dropdown instances.
   Opens one at a time — clicking another closes the previous.
   ============================================================ */

const DropdownManager = {
    OPEN_CLASS: 'open',
    _openId: null,

    /**
     * Set up all elements with [data-dropdown] or the
     * known dropdown wrappers by ID.
     */
    init() {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.dropdown-trigger');
            const panel   = dropdown.querySelector('.dropdown-panel');
            if (!trigger || !panel) return;

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = panel.classList.contains(this.OPEN_CLASS);

                // Close all first
                this._closeAll();

                if (!isOpen) {
                    panel.classList.add(this.OPEN_CLASS);
                    trigger.setAttribute('aria-expanded', 'true');
                    this._openId = dropdown.id;
                }
            });
        });
    },

    _closeAll() {
        document.querySelectorAll(`.dropdown-panel.${this.OPEN_CLASS}`).forEach(panel => {
            panel.classList.remove(this.OPEN_CLASS);
        });
        document.querySelectorAll('.dropdown-trigger[aria-expanded="true"]').forEach(btn => {
            btn.setAttribute('aria-expanded', 'false');
        });
        this._openId = null;
    },

    closeAll() {
        this._closeAll();
    }
};

// Expose for use in setupDropdowns()
function setupDropdowns() { DropdownManager.init(); }


/* ============================================================
   4. MODAL SYSTEM
   openModal(id)  — show a modal by its element ID
   closeModal(id) — hide a modal by its element ID
   ============================================================ */

/**
 * Open a modal.
 * @param {string} id - The ID of the modal backdrop element
 */
window.openModal = function (id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    // Remove hidden attribute to display it, then trigger animation
    modal.removeAttribute('hidden');
    modal.setAttribute('aria-hidden', 'false');

    // Focus first focusable element inside modal for accessibility
    const focusable = modal.querySelector('button, input, textarea, select, a[href]');
    if (focusable) {
        // Small delay lets CSS transition run
        setTimeout(() => focusable.focus(), 50);
    }

    // Prevent body scroll while modal is open
    document.body.style.overflow = 'hidden';
}

/**
 * Close a modal.
 * @param {string} id - The ID of the modal backdrop element
 */
window.closeModal = function (id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.setAttribute('hidden', '');
    modal.setAttribute('aria-hidden', 'true');

    // Restore body scroll
    document.body.style.overflow = '';
}

/**
 * Initialize modal system — wire up close-on-backdrop-click
 * and Escape key handler.
 */
function initModals() {
    // Close modal when clicking the backdrop (outside the modal card)
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                closeModal(backdrop.id);
            }
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-backdrop:not([hidden])').forEach(backdrop => {
                closeModal(backdrop.id);
            });
        }
    });
}


/* ============================================================
   5. CLICK OUTSIDE HANDLER
   Closes dropdowns and other floating UI when clicking outside.
   ============================================================ */

function handleOutsideClicks() {
    document.addEventListener('click', (e) => {
        // Close dropdowns if click is outside any .dropdown
        const isInsideDropdown = e.target.closest('.dropdown');
        if (!isInsideDropdown) {
            DropdownManager.closeAll();
        }
    });
}


/* ============================================================
   6. SCROLL REVEAL
   Lightweight IntersectionObserver-based reveal animation.
   Add class .reveal-on-scroll to any element to enable.
   ============================================================ */

function initScrollReveal() {
    // If IntersectionObserver is not supported, just show everything
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            el.classList.add('revealed');
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target); // Animate once only
                }
            });
        },
        {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        }
    );

    document.querySelectorAll('.reveal-on-scroll').forEach(el => {
        observer.observe(el);
    });
}


/* ============================================================
   7. KEYBOARD SHORTCUT — Search focus (⌘K / Ctrl+K)
   ============================================================ */

function initSearchShortcut() {
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const search = document.querySelector('.search-input');
            if (search) {
                search.focus();
                search.select();
            }
        }
    });
}


/* ============================================================
   8. STATUS BANNER DISMISS
   ============================================================ */

function initBannerDismiss() {
    document.querySelectorAll('.status-banner-close').forEach(btn => {
        btn.addEventListener('click', () => {
            const banner = btn.closest('.status-banner');
            if (banner) {
                banner.style.transition = 'opacity 0.2s, max-height 0.3s, padding 0.3s';
                banner.style.opacity = '0';
                banner.style.maxHeight = '0';
                banner.style.overflow = 'hidden';
                banner.style.padding = '0';
                setTimeout(() => banner.remove(), 350);
            }
        });
    });
}


/* ============================================================
   9. THEME TOGGLE — Public alias
   ============================================================ */

function toggleTheme() { ThemeManager.toggle(); }


/* ============================================================
   BOOT — Initialize all modules on DOMContentLoaded
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
    ThemeManager.init();
    SidebarManager.init();
    DropdownManager.init();
    handleOutsideClicks();
    initModals();
    initScrollReveal();
    initSearchShortcut();
    initBannerDismiss();
});

// // 1. CALENDAR SLOT SELECTION                                        
// // ║     Wire .slot-available click → open booking modal pre-filled     
                                                                   
//   document.querySelectorAll('.calendar-slot.slot-available').       
//     forEach(slot => {                                               
//       slot.addEventListener('click', () => {                        
//         const time = slot.textContent.trim();                       
//         const date = slot.closest('[data-date]')?.dataset.date;     
//         // Pre-fill #book-time and #book-date in modal              
//         document.getElementById('book-time').value = time;          
//         document.getElementById('book-date').value = date;          
//         openModal('modal-booking');                                  
//       });                                                            
//   });                                                                
                                                                    
// //   2. DRAG & DROP UPLOAD ZONE                                        
                                                                    
//   const zone = document.querySelector('.upload-zone');              
//   if (zone) {                                                        
//     zone.addEventListener('dragover', e => {                         
//       e.preventDefault(); zone.classList.add('drag-over');           
//     });                                                              
//     zone.addEventListener('dragleave', () => {                       
//       zone.classList.remove('drag-over');                           
//     });                                                              
//     zone.addEventListener('drop', e => {                             
//       e.preventDefault(); zone.classList.remove('drag-over');        
//       const files = e.dataTransfer.files;                            
//       // Submit files via FormData AJAX or Livewire                  
//     });                                                              
//   }                                                                  
                                                                    
// //   3. AJAX SLOT AVAILABILITY REFRESH                                  
// //      After booking submission, re-fetch slots via:                   
// //      GET /student/staff/{id}/slots                                   
// //      Then update .calendar-slot classes based on response JSON.      
                                                                    
// //   4. SEARCH SHORTCUT (already in app.js as initSearchShortcut)      
// //      ⌘K / Ctrl+K → focuses .search-input                            
                                                                    
// //   5. DOUBLE-BOOKING GUARD (server-side in AppointmentController)    
// //      Use DB transaction on store():  

//      DB::transaction(function () use ($request, $staffId) {          
//        $conflict = Appointment::where('staff_id', $staffId)          
//          ->where('requested_date', $request->date)                   
//          ->where('requested_start_time', $request->start)            
//          ->whereIn('status', ['pending','approved'])                  
//          ->lockForUpdate()->exists();                                 
//        if ($conflict) return back()->withErrors([...]);               
//        Appointment::create([...]);                                    
//      });                                              