<!-- Approve Modal -->
<div class="modal-backdrop" id="approve-modal" hidden role="dialog" aria-modal="true">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fa fa-check-circle"></i> Approve Appointment</h3>
            <button class="modal-close" onclick="closeModal('approve-modal')"><i class="fa fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <!-- modal content -->
            <div class="modal-info-row">
                <span class="modal-info-label">Student</span>
                <span class="modal-info-value">Angel Mtumbuka</span>
            </div>
            <div class="form-group">
                <label class="form-label">Note (optional)</label>
                <textarea class="form-textarea" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('approve-modal')">Cancel</button>
            <button class="btn btn-primary">Confirm</button>
        </div>
    </div>
</div>

<!-- Deny Modal -->
<div class="modal-backdrop" id="deny-modal" hidden role="dialog" aria-modal="true">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title modal-title-danger"><i class="fa fa-xmark-circle"></i> Deny Appointment</h3>
            <button class="modal-close" onclick="closeModal('deny-modal')"><i class="fa fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="modal-info-row">
                <span class="modal-info-label">Student</span>
                <span class="modal-info-value">Asante Katuli</span>
            </div>
            <div class="form-group">
                <label class="form-label">Reason for denial <span class="required-mark">*</span></label>
                <textarea class="form-textarea" rows="4" placeholder="Explain why this request is denied..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('deny-modal')">Cancel</button>
            <button class="btn btn-danger">Confirm Denial</button>
        </div>
    </div>
</div>

<!-- Info / Booking Modal (if needed) -->
<div class="modal-backdrop" id="modal-info" hidden role="dialog" aria-modal="true">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3 class="modal-title modal-title-info"><i class="fa fa-calendar-plus"></i> Book Appointment</h3>
            <button class="modal-close" onclick="closeModal('modal-info')"><i class="fa fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <!-- content -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-info')">Cancel</button>
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>