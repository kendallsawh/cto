<!-- Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addActivityModal">Add a new Activity to this PSIP</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Your Form Here -->
				<form class="" method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="d-none">
						<input type="text" name="psip" value="{{$psip->id}}">
					</div>
					<div class="mb-3">
						<label for="activity" class="form-label">Activity Name</label>
						<input value="{{ old('activity') }}" 
						type="text" 
						class="form-control" 
						name="activity" 
						required>

						@if ($errors->has('activity'))
						<span class="text-danger text-left">{{ $errors->first('activity') }}</span>
						@endif
					</div>
					<div class="mb-3">
						<label for="allocation" class="form-label">Allocation</label>
						<input value="{{ old('allocation') }}" 
						type="number" 
						class="form-control" 
						name="allocation" 
						required>

						@if ($errors->has('allocation'))
						<span class="text-danger text-left">{{ $errors->first('allocation') }}</span>
						@endif
					</div>       
					
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
