<div class="modal fade" id="advanceStepModal" tabindex="-1" aria-labelledby="advanceStepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form method="POST" id="advance-step-form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advance Step</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h6>Current Step: <span id="modal-step-name" class="text-primary fw-bold"></span></h6>
                    <p id="modal-step-description" class="text-muted"></p>

                    <hr>
                    <h6>Conditions</h6>
                    <ul id="modal-conditions" class="list-group list-group-flush"></ul>

                    <hr>
                    <h6>Actions</h6>
                    <ul id="modal-actions" class="list-group list-group-flush"></ul>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Confirm and Advance</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
