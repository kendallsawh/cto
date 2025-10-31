<!-- PAST ESTIMATE MODAL -->
<div class="modal fade" id="estModal" tabindex="-1" aria-labelledby="estModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				{{-- <h5 class="modal-title" id="estModalLabel">Edit</h5> --}}
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Your Form Here -->
				@if($psip_details_id)


					{{-- @if ($psip->psipDetailForPreviousYear->financialForYear($previousYear)) --}}
						<form class="" method="POST" action="{{ route('psip.updatepastEst') }}">
						@csrf


						<input name="psipupid" id="psipid" value="{{$psip_details_id}}" hidden>

						<div class="mb-3">
							<label for="past_estimate" class="form-label">Edit Past Estimate</label>
							<input type="number" class="form-control" id="past_estimate" name="past_estimate" >
						</div>
						<button type="submit" class="btn btn-primary">Edit</button>
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
						</form>
					{{-- @endif --}}
				@else
					<form class="" method="POST" action="{{route('psip.addpastEst')}}" enctype="multipart/form-data">
						@csrf
                         <h2>Show: {{$psip_details_id}}</h2>
						<input name="psipnameid" id="psipnameid" value="{{$psip->id}}" hidden >

						<input name="previousyear" id="previousyear" value="{{$previousYear}}" hidden >
						<div class="mb-3">
							<label for="past_actual" class="form-label">Add Past Estimate</label>
							<input type="number" class="form-control" id="past_estimate" name="past_estimate">
						</div>
						<button type="submit" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>
{{-- {{ route('psip.updatpastEst', $psip->id) }} --}}
{{-- {{ route('psip.addActual', $psip->id) }} --}}
