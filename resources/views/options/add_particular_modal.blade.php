<div class="modal fade" id="addParticularModal" tabindex="-1" aria-labelledby="addParticularModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addParticularModalLabel">Add Sub-Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addParticularForm">
                    @csrf
                    <div id="subActivityContainer">
                        <div class="sub-activity-row">
                            <input type="text" name="particulars[]" class="form-control" placeholder="Sub-Activity Name" required>
                            <input type="number" name="particulars_cost[]" class="form-control" placeholder="Cost" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="addMoreSubActivity">Add More</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
