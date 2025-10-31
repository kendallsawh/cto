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

/* Outline danger style */
.outline-danger {
    border: 1px solid #dc3545; /* Danger color (red) */
    background-color: transparent; /* Transparent background for outline effect */
    padding: 0.5rem 1rem; /* Adjust padding for button-like appearance */
    text-align: center;
    cursor: pointer;
}

.outline-danger a {
    color: #dc3545; /* Match text color to border */
    text-decoration: none; /* Ensure no underline */
}

/* Hover effect for outline-danger */
.outline-danger:hover {
    background-color: rgba(220, 53, 69, 0.1); /* Slight red tint on hover */
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

</style>
@endsection
@section('content')
@auth

    <div class="row">
        <div class="col-lg-2 text-decoration-dull">
            <nav id="book-tree" class="mb-xl" aria-label="Book Navigation">
                <h5>Your department /division's PSIP</h5>
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
        <div class="col-lg-8">
            <br>
            <div class="card text-decoration-dull" style="height: 80vh; overflow-y: auto;">
                <div class="card-body">
                    <h1 class="card-title">Draft Estimates of Development Programme Listing</h1>

                    <p class="lead">For financial {{$financial_year}}</p>
                    <hr>
                     <!-- Scrollable table wrapper -->
                    <div id="table-container" style="padding-bottom: 50px; overflow-x: auto;"> <!-- Extra space for the floating scrollbar -->

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item/Subitem/Project Group/Project Desc.</th>
                                    <th>Actual ({{ $twoYearsPrior }})</th>
                                    <th>Estimate ({{ $previousYear }})</th>
                                    <th>Revised Estimate ({{ $previousYear }})</th>
                                    <th>Estimate ({{ $financial_year }})</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($items as $item)
                                    <!-- Item Level -->
                                    <tr>
                                        <td><strong>{{ $item->item_code }}</strong></td>
                                        <td class="uppercase-text"><strong>{{ $item->item_name }}</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach($item->subitems as $subitem)
                                        <!-- Subitem Level -->
                                        <tr>
                                            <td style="padding-left: 30px;">{{ $subitem->sub_code }}</td>
                                            <td class="uppercase-text" style="padding-left: 10px;">
                                                - {{ $subitem->sub_name }}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach($subitem->groups as $group)
                                            <!-- Group Level -->
                                            <tr>
                                                <td style="padding-left: 40px;">{{ $group->group_code }}</td>
                                                <td class="uppercase-text" style="padding-left: 20px;">
                                                    -- {{ $group->group_name }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @foreach($group->psipNames as $psipName)
                                                <!-- PSIP Name Level -->
                                                <tr>
                                                    <td style="padding-left: 40px;">{{ $psipName->code }}</td>
                                                    <td style="padding-left: 30px;">
                                                        <a href="{{ route('psip.show', $psipName->id) }}"
                                                        style="text-decoration: none"
                                                        class="{{ $psipName->psipDetailForCurrentYear && $psipName->psipDetailForCurrentYear->psipFinancialsThisYear()->first() ? '' : 'text-danger' }}">
                                                            --- {{ $psipName->psip_name }}
                                                            <strong>
                                                                {{ $psipName->psipDetailForCurrentYear && $psipName->psipDetailForCurrentYear->psipFinancialsThisYear()->first() ? '' : '- '.$psipName->psipDetailsLast()->first()->financial_year }}
                                                            </strong>
                                                        </a>
                                                    </td>
                                                    <!-- Actual (two years prior) -->
                                                    <td>
                                                        {{
                                                            $psipName->psipDetailForTwoYearsPrior && $psipName->psipDetailForTwoYearsPrior->financialForYear($twoYearsPrior)
                                                            ? '$' . number_format($psipName->psipDetailForTwoYearsPrior->financialForYear($twoYearsPrior)->actual_expenditure, 2)
                                                            : '-'
                                                        }}
                                                    </td>
                                                    <!-- Estimate (previous year) -->
                                                    <td>
                                                        {{
                                                            $psipName->psipDetailForPreviousYear && $psipName->psipDetailForPreviousYear->financialForYear($previousYear)
                                                            ? '$' . number_format($psipName->psipDetailForPreviousYear->financialForYear($previousYear)->approved_estimates, 2)
                                                            : '-'
                                                        }}
                                                    </td>
                                                    <!-- Revised Estimate (previous year) -->
                                                    <td>
                                                        {{
                                                            $psipName->psipDetailForPreviousYear && $psipName->psipDetailForPreviousYear->financialForYear($previousYear)
                                                            ? '$' . number_format($psipName->psipDetailForPreviousYear->financialForYear($previousYear)->revised_estimates, 2)
                                                            : '-'
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            $psipName->psipDetailForCurrentYear && $psipName->psipDetailForCurrentYear->psipFinancialsThisYear()->first()
                                                            ? '$' . number_format($psipName->psipDetailForCurrentYear->psipFinancialsThisYear()->first()->revised_estimates, 2)
                                                            : '-'
                                                        }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
             <!-- Floating horizontal scrollbar -->
            <div id="horizontal-scrollbar" style="position: fixed; bottom: 0; left: 0; right: 0; height: 20px; background: #f1f1f1; z-index: 9999; overflow-x: auto;">
                <div style="width: max-content;">
                    <div style="width: 100%;">
                        <!-- Placeholder to make the scrollbar functional -->
                        <div id="scroll-sync" style="width: 100%; height: 1px;"></div>
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
                                        <span class="badge rounded-pill stacked-badge outline-danger mb-2">
                                            <a href="#" class="text-danger text-decoration-none">Red</a>
                                        </span>
                                    </td>
                                    <td class="text-decoration-dull">-Previous Year Data</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="badge rounded-pill stacked-badge outline-primary mb-2">
                                            <a href="#" class="text-primary text-decoration-none">Blue</a>
                                        </span>
                                    </td>
                                    <td class="text-decoration-dull">-Current Year Data</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h5 class="card-title">Actions</h5>
                        <a href="{{ route('home.index') }}" class="book entity-list-item  text-decoration-dull" data-entity-type="book" data-entity-id="1">
                            <span class="vertical-line text-decoration-dull-blue"></span>
                            <div class="content">
                                <h6 class="entity-list-item-name break-text">Switch to Default View (ordered by division)</h6>
                            </div>
                        </a>
                        <a href="{{ route('psip.prev_yrs') }}" class="book entity-list-item  text-decoration-dull" data-entity-type="book" data-entity-id="1">
                            <span class="vertical-line text-decoration-dull-blue"></span>
                            <div class="content">
                                <h6 class="entity-list-item-name break-text">View previous years</h6>
                            </div>
                        </a>

                    </div>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tableContainer = document.getElementById("table-container");
        const horizontalScrollbar = document.getElementById("horizontal-scrollbar");

        horizontalScrollbar.onscroll = function () {
            tableContainer.scrollLeft = horizontalScrollbar.scrollLeft;
        };

        tableContainer.onscroll = function () {
            horizontalScrollbar.scrollLeft = tableContainer.scrollLeft;
        };
    });
</script>


@endsection
