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

    .book-tree {
        font-family: Arial, sans-serif;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        background-color: #f9f9f9;
        width: 250px;
    }

    .book-tree h5 {
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .sidebar-page-list {
        list-style: none;
        margin: 0;
        padding: 5px 0;
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

    .entity-list-item:hover {
        background-color: #eaeaea;
        color: #333;
    }

    .vertical-line {
        width: 5px; /* Thickness of the line */
        height: 30px; /* Full height of the parent */
        background-color: #0078b9; /* Matches .text-decoration-dull-blue */
        margin-right: 20px;
        display: inline-block; /* Ensures the line behaves like an inline element */
        position: relative; /* Adjust positioning if needed */


    }

    button.book {
        background: none;
        border: none;
        margin: 0;
        padding: 0;
        width: 100%;  /* Ensure full width if your anchors span the container */
        display: flex;  /* Match the display type if your anchors use flex styles */
        align-items: center;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
    }

    .tutorial-disable{
        pointer-events: none;   /* To disable clicking on elements that could interrupt the tour */
    }
</style>
@endsection
@section('content')
@auth

    <div class="row">

        <div class="col-lg-2 text-decoration-dull" id="tutorial-sidebar-0-ns">



            <nav id="book-tree" class="mb-xl" aria-label="Book Navigation">
                <h5>Your department /division's PSIP</h5>

                <!-- Dummy Entry for Tutorial Overlay -->

                <a href="#" id="hidden-tutorial-sidebar" style="visibility: hidden" class="book entity-list-item  text-decoration-dull tutorial-overlay-sidebar" data-entity-type="book" >

                    <span class="vertical-line text-decoration-dull-blue"></span>
                    <div class="content">
                        <h6 class="entity-list-item-name break-text">000</h6>
                    </div>
                </a>

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
        <div class="col-lg-8" style="height: 80vh; overflow-y: auto;">
            <br>
            <div class="card text-decoration-dull">
                <div class="card-body">
                    <h1 class="card-title">PSIP  Listing - Ordered by Division</h1>

                    <p class="lead">For financial {{$financial_year}}</p>
                    <hr>

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
                            <!-- Dummy Row for Tutorial Overlay -->

                            <tr id="hidden-tutorial-dataentry" style="visibility: hidden">

                                <td class="fw-normal" style="color:rgb(34, 203, 255);">
                                    <a href="#" class="text-decoration-dull-blue" style="text-decoration: none; color:rgb(34, 203, 255);" id ="tutorial-dataentry-1">PSIP Tutorial - Training
                                    </a> <!-- Added this tag to fix the tutorial highlight -->
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-between align-items-start">
                                        <a href="#" class="text-decoration-dull-blue" style="text-decoration: none; color:rgb(34, 203, 255);" id ="tutorial-dataentry-2">Tutorial PSIP - <strong>000</strong>
                                        </a>

                                    <span class="badge rounded-pill stacked-badge outline-primary'}}" id ="tutorial-dataentry-3">
                                        <a href="#" class=" text-decoration-none" >CF</a>
                                    </span>
                                    </ul>
                                </td>
                                <td >
                                    <ul class="d-flex">
                                    <!-- The dummy link can be non-functional -->

                                    <span class="badge rounded-pill stacked-badge outline-warning">

                                    <a href="#" class="text-warning text-decoration-none tutorial-overlay-dataentry" title="This is where you click for Data Entry" id ="tutorial-dataentry-4">


                                        Data Entry (dummy)
                                    </a>
                                    </span>
                                    <span class="badge rounded-pill bg-danger" id ="tutorial-dataentry-5">Inactive</span>
                                    </ul>
                                </td>
                            </tr>
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
                                            <a href="#" class=" text-decoration-none">{{$psip->group->subitem->item->fundType->slug}}</a>
                                        </span>

                                    </ul>
                                    @empty
                                    <ul>No Projects</ul>

                                    @endforelse

                                </td>

                                <td>
                                    @forelse($division->psipNames as $psip)


                                    <ul class="d-flex">
                                        @role('planning|admin|ict|contributor')
                                        <span class="badge rounded-pill stacked-badge outline-warning">
                                            <a href="{{ route('dataentry.create', $psip->id) }}" class="text-warning text-decoration-none" data-bs-toggle="tooltip" title="Redirect to Data Entry form for entering PSIP Activities and Details">Data Entry</a>
                                        </span>
                                        @endrole
                                    <span class="badge rounded-pill bg-{{$psip->status_id==3?'danger':'success'}}" data-bs-toggle="tooltip" title="Psip can be either Active, Completed or Surpressed.">{{$psip->status->status}}</span>
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
        </div>
        <div class="col-lg-2 text-decoration-dull">

                <div class="">
                    <h5 class="card-title">Key/Legend for Fund Types</h5>
                    <div class="d-flex flex-column">
                        <table
                            class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="">
                                        <span class="badge rounded-pill stacked-badge outline-primary mb-2">
                                            <a href="#" class=" text-decoration-none">CF</a>
                                        </span>
                                    </td>
                                    <td class="text-decoration-dull">-Consolidated Fund</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="badge rounded-pill stacked-badge outline-success mb-2">
                                            <a href="#" class="text-success text-decoration-none">IDF</a>
                                        </span>
                                    </td>
                                    <td class="text-decoration-dull">-Infrastructure Development Fund</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h5 class="card-title">Actions</h5>
                        <a href="{{ route('home.moflisting') }}" id="tutorial-overlay-mof-listing-ns" class="book entity-list-item  text-decoration-dull" data-entity-type="book" data-entity-id="1">
                            <span class="vertical-line text-decoration-dull-blue"></span>
                            <div class="content">
                                <h6 class="entity-list-item-name break-text">Switch to Draft Estimates of Development Programme View</h6>
                            </div>
                        </a>
                        <a href="{{ route('psip.prev_yrs') }}" class="book entity-list-item  text-decoration-dull" data-entity-type="book" data-entity-id="1">
                            <span class="vertical-line text-decoration-dull-blue"></span>
                            <div class="content">
                                <h6 class="entity-list-item-name break-text">View previous years</h6>
                            </div>
                        </a>
                        <!-- Application UI elements -->
                        <a id="start-tutorial" class="book entity-list-item text-decoration-dull">
                            <span class="vertical-line text-decoration-dull-blue"></span>
                            <div class="content">
                                <h6 class="entity-list-item-name break-text">Start Tour</h6>
                            </div>
                        </a>

                    </div>
                </div>

        </div>

    </div>

@endauth
@guest
<div class="bg-light p-5 rounded">

    <h1>MALF Public Sector Investment Programme Database</h1>
    <p class="lead">Please login to view the restricted data.</p>

</div>
@endguest
@endsection
@section("scripts")
<!-- Define a global variable with the tutorial name -->
<script>
    // You can set the tutorial name (or an empty string if not defined)
    window.tutorialConfig = {
        tutorialName: "{{ $tutorialName ?? '' }}"
    };
</script>
<!-- Include the tour script -->
<script src="{!! url('js/tutorial.overlay.js') !!}"></script>

@endsection
