@extends('layouts.app-master')
@section('css')
<style type="text/css">
    .stacked-badge-prev, .btn-stacked {
      display: block;
      width: 100%; /* Makes it take full available width */
      margin-bottom: 5px; /* Adds a little margin for separation */
      text-align: center; /* Centers the text */
  }

.icon-spacing {
    margin-right: 5px; /* Adjust the space as needed */
}


/* Shared outline style */
.stacked-badge {
    border: 1px solid; /* Default border */
    background-color: transparent; /* Transparent background for outline effect */
    padding: 0.5rem 1rem; /* Adjust padding for button-like appearance */
    text-align: center;
    cursor: pointer;
}

/* Specific colors for outline */
.outline-primary {
    border-color: #0078b9; /* Primary color, actually its a dull blue based on bookstack blue color */
}

.outline-primary a{
    color: #0078b9; /* Ensure text matches the border */
}

.outline-success {
    border-color: #28a745; /* Success color */
}

.outline-success a {
    color: #28a745;
}

.outline-info {
    border-color: #17a2b8; /* Info color */
}

.outline-info a {
    color: #17a2b8;
}

/* Outline warning style */
.outline-warning {
    border: 1px solid #ffc107; /* Warning color */
    background-color: transparent; /* Transparent background for outline effect */
    padding: 0.5rem 1rem; /* Adjust padding for button-like appearance */
    text-align: center;
    cursor: pointer;
}

.outline-warning a {
    color: #ffc107; /* Match text color to border */
    text-decoration: none; /* Ensure no underline */
}

/* Hover effect for outline-warning */
.outline-warning:hover {
    background-color: rgba(255, 193, 7, 0.1); /* Slight yellow tint on hover */
}

/* Hover effect */
.stacked-badge:hover {
    background-color: rgba(0, 0, 0, 0.05); /* Slight background color change on hover */
}



</style>
@endsection
@section('content')
@auth


    <div class="card text-decoration-dull">
        <div class="card-body">
            <h1 class="card-title">Division Listing</h1>

            <p class="lead">For financial {{$financial_year}}</p>
            <hr>

            <div class="row" name="options-and-key">
                <!-- Right column with the department data -->
                <div class="col-lg-9">
                    @if(auth()->user()->psipNames->isNotEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>PSIP for your division/department</h5>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (auth()->user()->psipNames as $psipName)
                        <div class="col-lg-1  mb-2">
                            <a href="{{ route('psip.show', $psipName->id) }}" class="btn bg-bookstack-blue text-light" style="text-decoration: none;">
                                <i class="bi bi-folder"></i> {{$psipName->code}}
                            </a>
                        </div>
                        @endforeach
                    </div>

                    @endif
                </div>
                <div class="col-lg-3">
                    <div class="card p-3 mb-3">
                        <h6 class="card-title">Key/Legend</h6>
                        <div class="d-flex flex-column">
                            <span class="badge rounded-pill stacked-badge outline-primary mb-2">
                                <a href="#" class=" text-decoration-none">CF - Consolidated Fund</a>
                            </span>

                            <span class="badge rounded-pill stacked-badge outline-success mb-2">
                                <a href="#" class="text-success text-decoration-none">IDF - Infrastructure Development Fund</a>
                            </span>

                            <span class="badge rounded-pill stacked-badge outline-info">
                                <a href="{{ route('psip.prev_yrs') }}" class="text-info text-decoration-none">View previous years</a>
                            </span>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <table class="table  table-hover">
                <thead>
                    <tr>

                        <th>Division Name</th>
                        <th>PSIP</th>
                        @role('admin')
                        <th width="10%" colspan="3">Status</th>
                        @endrole
                        @role('planning|ict|contributor')
                        <th width="3%" colspan="3">Status</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $key => $division)
                    <!-- {{ $division->psipNames->count() == 0 ? 'table-warning' : '' }} use this to highlight rows -->
                    <tr class="">


                        <td class="fw-normal">{{ $division->division_name }} -

                        </td>
                        <td>
                            @forelse($division->psipNames as $psip)
                            <ul class="d-flex justify-content-between align-items-start">
                                <a href="{{ route('psip.show', $psip->id) }}" class="text-decoration-dull-blue" style="text-decoration: none">{{$psip->psip_name}} - <strong>{{$psip->code}}</strong>
                                </a>
                                <span class="badge rounded-pill stacked-badge outline-{{$psip->group->subitem->item->fundType->id==1?'success':'primary'}}"
                                    data-bs-toggle="tooltip"
                                    title="PSIP can be either Consolidated Fund or Infrastructure Development Fund">
                                    <a href="#" class=" text-decoration-none">Fund Type: {{$psip->group->subitem->item->fundType->slug}}</a>
                                </span>

                            </ul>
                            @empty
                            <ul>No Projects</ul>

                            @endforelse

                        </td>

                        <td>
                            @forelse($division->psipNames as $psip)


                            <ul class="d-flex">
                                @role('planning|admin')
                                <span class="badge rounded-pill stacked-badge outline-warning">
                                    <a href="{{ route('dataentry.create', $psip->id) }}" class="text-warning text-decoration-none">Data Entry</a>
                                </span>
                                @endrole
                            <span class="badge rounded-pill bg-{{$psip->status_id==3?'danger':'success'}}" data-bs-toggle="tooltip" title="Psip can be either active or completed or surpressed.">{{$psip->status->status}}</span>
                            </ul>

                            @empty
                            @endforelse
                        </td>
                        <!-- <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('psipupload.edit', $division->id) }}">Edit PSIP</a>
                        </td> -->

                    </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex">
                {!! $divisions->links() !!}
            </div>
        </div>

    </div>


@endauth
@guest
<div class="bg-light p-5 rounded">

    <h1>Homepage</h1>
    <p class="lead">Please login to view the restricted data.</p>

</div>
@endguest
@endsection
@section("scripts")
<script type="text/javascript">


</script>

@endsection
