@extends('layouts.app-master')

@section('content')
@auth
@include('layouts.partials.messages')
    <div class="bg-light p-4 rounded">
        <h2>PSIP Data Entry</h2>
        <div class="lead">
            <h6>Use this page to enter all the information for a PSIP including the Activities, Sujb Activities and Financial Data.</h6>
        </div>
        <div class="container mt-4">
            <form method="POST" action="{{ route('dataentry.store', $psip->id) }}" enctype="multipart/form-data">
                @csrf
                <!-- PSIP Names Section -->
                <!-- PSIP Details Section for Current Financial Year -->

                <div class="form-group">
                    <label for="financial_year">Financial Year</label>
                    <input type="number" min="2025" max="2099" step="1" class="form-control" id="financial_year" name="financial_year"  value="{{ old('financial_year', '2025') }}" />
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Drag lower right hand corner to expand."
                        >{{ old('description') }}</textarea>

                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <br>
                <hr>
                <h6>PSIP Financials</h6>
                <!-- Financials Section -->
                <div class="mb-3">
                    <label for="current_allocation" class="form-label">Most recent allocation</label>
                    <input value="{{ old('current_allocation') }}"
                           type="number"
                           class="form-control"
                           name="current_allocation"
                           placeholder="Numerical values only."
                           required>

                    @if ($errors->has('current_allocation'))
                        <span class="text-danger text-left">{{ $errors->first('current_allocation') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="approved_allocation" class="form-label">Approved allocation</label>
                    <input value="{{ old('approved_allocation') }}"
                           type="number"
                           class="form-control"
                           name="approved_allocation"
                           placeholder="Numerical values only."
                           required>

                    @if ($errors->has('approved_allocation'))
                        <span class="text-danger text-left">{{ $errors->first('approved_allocation') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="revised_allocation" class="form-label">Revised estimates</label>
                    <input value="{{ old('revised_allocation') }}"
                           type="number"
                           class="form-control"
                           name="revised_allocation"
                           placeholder="Numerical values only."
                           required>

                    @if ($errors->has('revised_allocation'))
                        <span class="text-danger text-left">{{ $errors->first('revised_allocation') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="actual_expenditure" class="form-label">Actual expenditure(Actual amount spent so far)</label>
                    <input value="{{ old('actual_expenditure') }}"
                           type="number"
                           class="form-control"
                           name="actual_expenditure"
                           placeholder="Numerical values only."
                           required>

                    @if ($errors->has('actual_expenditure'))
                        <span class="text-danger text-left">{{ $errors->first('actual_expenditure') }}</span>
                    @endif
                </div>

                <!-- Activities Section (Dynamic) -->
                <div class="d-flex align-items-center mt-2">
                    <h6>Activities</h6>
                    {{-- <span class="badge stacked-badge btn btn-primary">
                        <a href="" class="text-light text-decoration-none" data-bs-toggle="tooltip" title=" Add Another Activity" onclick="window.addActivity()"><i class="bi bi-plus"></i></a>
                    </span> --}}
                </div>
                <div id="activitiesContainer">
                    <div class="activity-section mb-3">
                        <div class="form-group">
                            <label for="activity_name" class="mb-0 me-2">Activity Name</label>
                            <div class="d-flex align-items-center mt-2">
                                <input type="text" class="form-control" name="activity_name[0]" placeholder="Activity 1" value="{{ old('activity_name.0') }}">
                                <button type="button" class="btn btn-danger btn-sm ms-2" onclick="window.removeActivity(this)" style="display: none;">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>

                        </div>
                        <div class="particularsContainer mt-2"></div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2 add-activity-btn" onclick="window.addParticular(this, 0)" data-bs-toggle="tooltip" title="Add sub activities that would be part of this activity, including the funds that would be allocated to this sub-activity">Add Sub-Activity</button>
                        </div>
                    </div>
                </div>
                <!-- Floating Add Activity Button -->
                <button type="button" class="btn btn-primary btn-floating" onclick="window.addActivity()" style="position: fixed; bottom: 20px; right: 20px;" data-bs-toggle="tooltip" title=" Add Another Activity">
                    <i class="bi bi-plus"></i>
                </button>
                {{-- <button type="button" class="btn btn-primary btn-sm mt-3" onclick="window.addActivity()">Add Activity</button> --}}

                <!-- Align Save Button to the Right -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn bg-bookstack-blue text-light mt-4">Save</button>
                </div>

            </form>
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
let activityIndex = 1; // Keep track of the number of activity sections

// Making the functions explicitly global by attaching them to the window object
window.addActivity = function() {
    const activityContainer = document.getElementById("activitiesContainer");

    // Create new activity section
    const newActivitySection = document.createElement("div");
    newActivitySection.className = "activity-section mb-3";

    // Populate the new activity section with form fields
    newActivitySection.innerHTML = `
        <div class="form-group">
            <label for="activity_name" class="mb-0">Activity Name</label>
            <div class="d-flex align-items-center mt-2">
                <input type="text" class="form-control" name="activity_name[${activityIndex}]" placeholder="Activity ${activityIndex + 1}" value="">
                <button type="button" class="btn btn-danger btn-sm ms-2" onclick="window.removeActivity(this)">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
        <div class="particularsContainer mt-2"></div>
        <div class="d-flex justify-content-end mt-4">
            <button type="button"
            class="btn btn-outline-secondary btn-sm mt-2 add-activity-btn"
            onclick="window.addParticular(this, ${activityIndex})"
            data-bs-toggle="tooltip" title="Add sub activities that would be part of this activity, including the funds that would be allocated to this sub-activity">
                Add Sub-Activity
            </button>
        </div>

    `;

    // Append new activity section to the container
    activityContainer.appendChild(newActivitySection);

    // Increment the activity index
    activityIndex++;
}

window.addParticular = function(buttonElement, activityIndex) {
    const activitySection = buttonElement.closest('.activity-section');
    const particularsContainer = activitySection.getElementsByClassName('particularsContainer')[0];

    // Create new particular section
    const newParticularSection = document.createElement("div");
    newParticularSection.className = "particular-section mb-2";

    // Populate with form fields
    newParticularSection.innerHTML = `
        <div class="d-flex align-items-center mb-2">
            <h6 class="mb-0">Sub-Activities</h6>
            <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="window.removeParticular(this)">
                <i class="bi bi-trash3"></i>
            </button>
        </div>
        <div class="form-group" style="padding-left: 30px;">
            <label for="particulars">Description</label>
            <input type="text" class="form-control" name="particulars[${activityIndex}][]" placeholder="Sub-Activity Description" value="">
        </div>
        <div class="form-group" style="padding-left: 30px;">
            <label for="particulars_cost">Amount</label>
            <input type="number" step="0.01" class="form-control" name="particulars_cost[${activityIndex}][]" placeholder="Sub-Activity Amount" value="">
        </div>
    `;

    // Append to the particulars container
    particularsContainer.appendChild(newParticularSection);
}

window.removeActivity = function(buttonElement) {
    const activitySection = buttonElement.closest('.activity-section');
    activitySection.remove();
}

window.removeParticular = function(buttonElement) {
    const particularSection = buttonElement.closest('.particular-section');
    particularSection.remove();
}
</script>
@endsection
