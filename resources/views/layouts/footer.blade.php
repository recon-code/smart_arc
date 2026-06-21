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
    <div class="modal-backdrop" id="approve-modal" role="dialog" aria-modal="true" aria-labelledby="approve-title" hidden>
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
    <div class="modal-backdrop" id="deny-modal" role="dialog" aria-modal="true" aria-labelledby="deny-title" hidden>
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
