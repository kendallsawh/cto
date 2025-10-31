<!-- options/edit_activity_particular.blade.php -->
<div class="modal fade" id="editActivityParticularModal" tabindex="-1" aria-labelledby="editActivityParticularLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editActivityParticularLabel">Edit Activity Particular</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editActivityParticularForm" method="POST" action="{{ route('activity_particulars.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="activity_particular_id">

                    <div class="mb-3">
                        <label for="particulars" class="form-label">Particulars</label>
                        <textarea class="form-control" name="particulars" id="particulars" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="particulars_cost" class="form-label">Cost</label>
                        <input type="number" class="form-control" name="particulars_cost" id="particulars_cost" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
