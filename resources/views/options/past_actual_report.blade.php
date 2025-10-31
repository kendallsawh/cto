{{-- PAST ACTUAL REPORT MODAL --}}

<div class="modal fade" id="actModal" tabindex="-1" aria-labelledby="actModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				{{-- <h5 class="modal-title" id="estModalLabel">Edit</h5> --}}
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Your Form Here -->
				@if($psip_details_idtwoyear)


					{{-- @if ($psip->psipDetailForPreviousYear->financialForYear($previousYear)) --}}
						<form class="" method="POST" action="{{ route('psip.updatepastAct') }}">
						@csrf

						<input name="psipupid" id="psipid" value="{{$psip_details_idtwoyear}}" hidden>
						<div class="mb-3">
							<label for="past_actual" class="form-label">Edit Past Actual</label>
							<input type="number" class="form-control" id="past_actual" name="past_actual" >
						</div>
						<button type="submit" class="btn btn-primary">Edit</button>
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
						</form>
					{{-- @endif --}}
				@else
					<form class="" method="POST" action="{{route('psip.addpastAct')}}" enctype="multipart/form-data">
						@csrf
                         <h2>Show: {{$psip_details_idtwoyear}}</h2>
						<input name="psipnameid" id="psipnameid" value="{{$psip->id}}" hidden >

						<input name="previoustwoyear" id="previoustwoyear" value="{{$twoYearsPrior}}" hidden >
						<div class="mb-3">
							<label for="past_actual" class="form-label">Add Past Actual</label>
							<input type="number" class="form-control" id="past_actual" name="past_actual">
						</div>
						<button type="submit" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>
