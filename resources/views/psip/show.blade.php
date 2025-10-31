@extends('layouts.app-master')
@section('css')
<style type="text/css">
.custom-nav-pills .nav-link {
    background-color: lightgray;
    color: #606070;  /* Choose the text color you prefer */
}


.custom-nav-pills .nav-link.active {
    /*
    No Space between .nav-link and .active means you're targeting an element that has both classes at the same time.
    In this case, it's saying, "Select an element that has both the .nav-link and .active classes."
    */
    background-color: #0078b9;  /* Bootstrap's default active color #007bff; change as needed */
    color: #ffffff; /* White text for active pill */
}

.custom-container > div {
    flex-grow: 0;
    flex-shrink: 0;
}

.entity-list-item {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: background-color 0.2s ease, color 0.2s ease;
        padding: 2px 10px;/* Adjust inner padding (top/bottom: 5px, left/right: 10px) */
        border-radius: 5px;
        position: relative;
        min-height: 30px; /* Ensure the line has enough space to display */
        display: flex; /* Aligns the line and text content properly */
        align-items: center; /* Vertically centers the text and line */
    }

    .vertical-line {
        width: 5px; /* Thickness of the line */
        height: 30px; /* Full height of the parent */
        background-color: #0078b9; /* Matches .text-decoration-dull-blue */
        margin-right: 20px;
        display: inline-block; /* Ensures the line behaves like an inline element */
        position: relative; /* Adjust positioning if needed */


    }

    .tutorial-disable{
        pointer-events: none; /* To disable clicking on elements that could interrupt the tour */
    }
</style>
@endsection
@section('content')
@auth
@include('layouts.partials.messages')

    <div class="row">
        {{-- first column --}}
        <div class="col-lg-1">
            <nav id="book-tree" class="mb-xl" aria-label="Book Navigation">

                <h5 class="card-title">Actions</h5>
                <!-- Application UI elements -->
                <a id="start-second-tutorial" class="book entity-list-item text-decoration-dull">
                    <span class="vertical-line text-decoration-dull-blue"></span>
                    <div class="content">
                        <h6 class="entity-list-item-name break-text">Start PSIP Details Tour</h6>
                    </div>
                </a>
                <a id="nextcloud" class="book entity-list-item text-decoration-dull" data-bs-toggle="modal" data-bs-target='#nextcloudmodal'>
                    <span class="vertical-line text-decoration-dull-blue"></span>
                    <div class="content">
                        <h6 class="entity-list-item-name break-text">Next Cloud</h6>
                    </div>
                </a>


                <h5>Your PSIPs</h5>
                @if(auth()->user()->psipNames->isNotEmpty())
                    @foreach (auth()->user()->psipNames as $psipName)


                                <a href="{{ route('psip.show', $psipName->id) }}" class="book entity-list-item  text-decoration-dull" data-entity-type="book" data-entity-id="1" data-bs-toggle="tooltip" title="{{$psipName->psip_name}}. Details: {{$psipName->psipDetailForCurrentYear?$psipName->psipDetailForCurrentYear->details:'None Provided'}}">
                                    <span class="vertical-line text-decoration-dull-blue"></span>
                                    <div class="content">
                                        <h6 class="entity-list-item-name break-text">{{$psipName->code}}</h6>
                                    </div>
                                </a>

                    @endforeach
                @endif
            </nav>
        </div>
        {{-- second column --}}
        <div class="col-lg-10">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center text-decoration-dull">Activities/ Documents for PSIP: {{$title}}
                                    @role('admin|planning')
                                    <div class="btn-group" id ="tutorial-details-0-ns">
                                        <button type="button" class="btn btn-light btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('psip.edit', $psip->id) }}">Edit PSIP</a></li>
                                            <li><a class="dropdown-item" href="{{ route('psip.projection', $psip->id) }}">Add projections for another year</a></li>
                                            <!-- Modal Trigger Here -->
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#screeningBriefModal">Add Screening Brief</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#psNoteModal">Add PS Note</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#formModal">Assign/Request a document to be uploaded</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cancelPsipModal">Suppress this PSIP</a></li>
                                            <!-- the below code shoul not be removed, this is the link to update all psip to the new financial year -->
                                            <!-- <li><a class="dropdown-item" href="{{ route('update.all.psip') }}">update all psip(dont touch right now)</a></li> -->
                                        </ul>
                                    </div>
                                    @endrole
                                    @role('ict|contributor')
                                    <div class="btn-group" id ="tutorial-details-0-1-ns">
                                        <button type="button" class="btn btn-light btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#psNoteModal">Add Screening Brief</a></li>
                                        </ul>
                                    </div>

                                    @endrole
                                </h2>
                                <p><h5 class="text-center">(Status - {{App\Models\Status::find($psip->status_id)->status}})
                                    @if($psip->status_id==1)
                                        <i class="bi bi-check-lg text-success"></i>

                                    @else
                                        <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                                    @endif
                                    </h5>
                                </p>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="container">
                <div class="card">
                   <!-- Pills navigation -->
                <ul class="nav nav-pills nav-justified mb-3 custom-nav-pills" id="myTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pill2-tab" data-bs-toggle="pill" href="#pill2" role="tab" aria-controls="pill2" aria-selected="true">Activities</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="pill1-tab" data-bs-toggle="pill" href="#pill1" role="tab" aria-controls="pill1" aria-selected="false">Financial Summary</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pill3-tab" data-bs-toggle="pill" href="#pill3" role="tab" aria-controls="pill3" aria-selected="false">Projections</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pill4-tab" data-bs-toggle="pill" href="#pill4" role="tab" aria-controls="pill4" aria-selected="false">Prior Years</a>
                    </li> --}}
                </ul>

                <!-- Pills content -->
                <div class="tab-content" id="myTabsContent">

                    @include('psip.pills.pill_2')<!-- Activities Pill -->
                    @include('psip.pills.pill_1')<!-- Fininacial Pill -->
                    <!-- Pills that are not in use for now until more information is gathered. just include the 'include' infront of them to reactive them -->
                    <!-- Projections Pill
                        ('psip.pills.pill_3')
                    -->
                    <!-- Prior Years Pill
                        ('psip.pills.pill_4')
                    -->
                </div>
                </div>

            </div>
        </div>
        {{-- third column --}}
        <div class="col-lg-1">

        </div>
    </div>

    <div class="p-5 rounded">

    </div>


    <!-- if user division == psip division or if admin user or planning user or if user is in planning -->
    @if((auth()->user()->divisions_id == $psip->division_id) || (auth()->user()->id==2 ||auth()->user()->id==1) || auth()->user()->divisions_id == 15)
    @include('options.assign_doc2')
    @include('options.edit_psip_detail')
    @include('options.approved_estimate')
    @include('options.revised_estimate')
    @include('options.current_expenditure')
    @include('options.required_documents')
    @include('options.cancel_activity')
    @include('options.remove_activity')
    @include('options.cancel_psip')
    @include('options.update_doc')
    @include('options.screening_brief')
    @include('options.add_ps_note')
    @include('options.achievement_report')
    @include('options.add_activity_modal')
    @include('options.edit_activity_particular')
    @endif
    @include('psip.nextcloudModal')
    @include('options.add_particular_modal')
    @include("options.past_estimate")
    @include('options.advance_step_modal')
@endauth
@guest
    <div class="bg-light p-5 rounded">
        <h1>Homepage</h1>
        <p class="lead">Please login to view the restricted data.</p>
    </div>
@endguest
@endsection
@section("scripts")
@include('psip.scripts.show-scripts')
@include('psip.scripts.show-docgroup-scripts')
@include('psip.scripts.advance_step_modal_js')
@include("options.past_actual_report")
@include("options.past_rev_estimate")
@include("options.add_particular_modal")
<script>
    // Tutorial information for the admin and planning roles.
    @role('admin|planning')
    window.tutorialConfig = {
        tutorialName: "{{ $tutorialName ?? 'psip-page-dataentry-admin-plan' }}"
    };
    window.roleid = 12;
    @endrole

    // Tutorial information for the ict and contributor roles.
    @role('ict|contributor')
    window.tutorialConfig = {
        tutorialName: "{{ $tutorialName ?? 'psip-page-dataentry-ict-contri' }}"
    };
    window.userdivid = {{auth()->user()->divisions_id}};
    window.psipdivid = {{$psip->division_id}};
    window.roleid = 34;
    @endrole

    function toggleView() {
        const tableView = document.getElementById('tableView');
        const accordionView = document.getElementById('accordionView');
        const toggleSwitch = document.getElementById('viewToggleSwitch');

        if (toggleSwitch.checked) {
            accordionView.classList.add('d-none');
            tableView.classList.remove('d-none');
        } else {
            tableView.classList.add('d-none');
            accordionView.classList.remove('d-none');
        }
    }
</script>


<script src="{!! url('js/tutorial.overlay.js') !!}"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

{{-- use the laravel include and use psip.show-chart-scripts inside of it if you want to see the chart graphics but there seems to be an error so i disabled it --}}


    @endsection
