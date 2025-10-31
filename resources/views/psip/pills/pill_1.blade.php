<div class="tab-pane fade" id="pill1" role="tabpanel" aria-labelledby="pill1-tab">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @if($psip->psipDetailForCurrentYear)

                <!-- Current Financial Data -->
                <div class="card mb-3">
                    <div class="card-header">Current Financial Data</div>
                    <div class="card-body">
                        <h4>Fiscal {{$psip->psipDetailForCurrentYear->financial_year}}</h4>
                        <hr>
                        @if((auth()->user()->divisions_id == $psip->division_id) || (auth()->user()->id==2) || (auth()->user()->divisions_id == 15))

                            <div class="d-flex align-items-center mt-2">
                                <span><strong>Current Expenditure</strong><i>{{ $current_expenditure_dt ? ' as of ' . $current_expenditure_dt : '' }}</i>:</span>
                                <span class="ms-2">
                                    {{ optional($psip->psipDetailForCurrentYear->psipFinancialsThisYear()->first())->current_expenditure ?? '0.00' }}
                                </span>
                                @role('admin|planning')
                                <div class="dropdown ms-3">
                                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#currExpModal">Edit Current Expenditure</a></li>
                                    </ul>
                                </div>
                                @endrole
                            </div>

                            <div class="d-flex align-items-center mt-2">
                                <span><strong>Approved Allocation</strong>:</span>
                                <span class="ms-2">
                                    {{ optional($psip->psipDetailForCurrentYear->psipFinancialsThisYear()->first())->approved_estimates ?? '0.00' }}
                                </span>
                                @role('admin|planning')
                                <div class="dropdown ms-3">
                                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#appEstModal">Edit Approved Estimate</a></li>
                                    </ul>
                                </div>
                                @endrole
                            </div>

                            <div class="d-flex align-items-center mt-2">
                                <span><strong>Revised Allocation</strong>:</span>
                                <span class="ms-2">
                                    {{ optional($psip->psipDetailForCurrentYear->psipFinancialsThisYear()->first())->revised_estimates ?? '0.00' }}
                                </span>
                                @role('admin|planning')
                                <div class="dropdown ms-3">
                                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#revEstModal">Edit Revised Estimate</a></li>
                                    </ul>
                                </div>
                                @endrole
                            </div>

                            <div class="d-flex align-items-center mt-2">
                                <span><strong>Actual Expenditure ({{$psip->psipDetailForCurrentYear->financial_year}})</strong>:</span>
                                <span class="ms-2">
                                    {{ optional($psip->psipDetailForCurrentYear->psipFinancialsThisYear()->first())->actual_expenditure ?? '0.00' }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Financial Breakdown for Each Activity -->
                <div class="card mb-3">
                    <div class="card-header">Financial Breakdown for Each Activity</div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-2">

                                        <!-- Updated Table in pill_1.blade.php -->
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Activity Name</th>
                                                    <th>Tasks/Sub Activities</th>
                                                    <th>Cost</th>
                                                    @role('admin')
                                                        <th width="10%" colspan="3">Actions</th>
                                                    @endrole
                                                    @role('planning|ict|contributor')
                                                        <th width="3%" colspan="3">Actions</th>
                                                    @endrole
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activities as $activity)
                                                    @if ($activity->activityParticulars->count() > 0)
                                                        @foreach ($activity->activityParticulars as $index => $activity_particular)
                                                            <tr>
                                                                @if ($index == 0)
                                                                    <td rowspan="{{ $activity->activityParticulars->count() }}">
                                                                        {{ $activity->activity_name }}
                                                                    </td>
                                                                @endif
                                                                <td class="fw-normal">

                                                                    <button class="btn btn-link text-decoration-dull-blue edit-activity-particular"
                                                                            style="text-decoration: none"
                                                                            data-id="{{ $activity_particular->id }}"
                                                                            data-particulars="{{ $activity_particular->particulars }}"
                                                                            data-cost="{{ $activity_particular->particulars_cost }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editActivityParticularModal">
                                                                            {{ $activity_particular->particulars }}
                                                                        </button>

                                                                </td>
                                                                <td>{{ $activity_particular->particulars_cost }}</td>
                                                                @if ($index == 0)
                                                                <td>
                                                                    @role('planning|admin|ict|contributor')

                                                                            <button class="btn btn-sm btn-primary add-sub-activity" data-activity-id="{{ $activity->id }}">
                                                                                Add Sub-Activity
                                                                            </button>
                                                                    @endrole
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>{{ $activity->activity_name }}</td>
                                                            <td>No Data</td>
                                                            <td>$0.00</td>
                                                            <td>
                                                                @role('planning|admin|ict|contributor')

                                                                <button class="btn btn-sm btn-primary add-sub-activity" data-activity-id="{{ $activity->id }}">
                                                                    Add Sub-Activity
                                                                </button>
                                                                @endrole
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                    </div>
                </div>

                <!-- Previous Year Financial Data -->
                <div class="card mb-3">
                    <div class="card-header">Financial Data from Previous Years</div>
                    <div class="card-body">
                        <!-- Revised Estimate (previous year) -->
                                    <div class="d-flex align-items-center mt-2">
                                        <span><strong>Revised Estimate</strong><i> ({{ $previousYear }})</i>:</span>

                                        <span class="ms-2">
                                            {{
                                                $psip->psipDetailForPreviousYear && $psip->psipDetailForPreviousYear->financialForYear($previousYear)
                                                ? '$' . number_format($psip->psipDetailForPreviousYear->financialForYear($previousYear)->revised_estimates, 2)
                                                : '-'
                                            }}
                                        </span>

                                        @role('admin|planning')
                                        <div class="">
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if($psip->psipDetailForPreviousYear && $psip->psipDetailForPreviousYear->financialForYear($previousYear))
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#rev_estModal">Edit Revised Estimate</a></li>
                                                    @else
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#rev_estModal">Edit Revised Estimate</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        @endrole
                                    </div>

                                    <!-- Estimate (previous year) -->
                                    <div class="d-flex align-items-center mt-2">
                                        <span><strong>Estimate</strong><i> ({{ $previousYear }})</i>:</span>

                                        <span class="ms-2">
                                            {{
                                                $psip->psipDetailForPreviousYear && $psip->psipDetailForPreviousYear->financialForYear($previousYear)
                                                ? '$' . number_format($psip->psipDetailForPreviousYear->financialForYear($previousYear)->approved_estimates, 2)
                                                : '-'
                                            }}
                                        </span>

                                        @role('admin|planning')
                                        <div class="">
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                @if($psip->psipDetailForPreviousYear && $psip->psipDetailForPreviousYear->financialForYear($previousYear))
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#estModal">Edit Estimate</a></li>
                                                @else
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#estModal">Add Estimate</a></li>
                                                @endif
                                                </ul>
                                            </div>
                                        </div>
                                        @endrole
                                    </div>

                                    <!-- Actual (two years prior) -->
                                    <div class="d-flex align-items-center mt-2">
                                        <span><strong>Actual</strong><i> ({{ $twoYearsPrior }})</i>:</span>

                                        <span class="ms-2">
                                            {{
                                                $psip->psipDetailForTwoYearsPrior && $psip->psipDetailForTwoYearsPrior->financialForYear($twoYearsPrior)
                                                ? '$' . number_format($psip->psipDetailForTwoYearsPrior->financialForYear($twoYearsPrior)->actual_expenditure, 2)
                                                : '-'
                                            }}
                                        </span>

                                        @role('admin|planning')
                                        <div class="">
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">

                                                    @if($psip->psipDetailForTwoYearsPrior && $psip->psipDetailForTwoYearsPrior->financialForYear($twoYearsPrior))
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#actModal">Edit Actual</a></li>
                                                    @else
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#actModal">Add Actual</a></li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                        @endrole
                                    </div>
                    </div>
                </div>


                @else
                <h5>No Data Found</h5>
                @endif

            </div>
        </div>
    </div>
</div>
