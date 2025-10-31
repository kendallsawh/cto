<div class="tab-pane fade active show" id="pill2" role="tabpanel" aria-labelledby="pill2-tab">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="lead">
                                <p class="text-decoration-dull d-inline-block mb-0">
                                    <strong>Details for {{$psip->psipDetailForCurrentYear? $psip->psipDetailForCurrentYear->financial_year : $financial_year}}</strong>
                                </p>
                                @if((auth()->user()->divisions_id == $psip->division_id) || (auth()->user()->id==2 ||auth()->user()->id==1) || auth()->user()->divisions_id == 15)
                                <div class="dropdown d-inline-block" id ="tutorial-details-2-ns">
                                    <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="bi bi-three-dots" style="font-size: 1.2rem;color: cornflowerblue;"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#psipDetailModal" class="dropdown-item">Edit Details</a>

                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            {{$psip->psipDetailForCurrentYear?$psip->psipDetailForCurrentYear->details:'No details found'}}
                        </p>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <!-- document data -->
                    <div class="col-md-12" id="left-column">
                        @if($psip->psipDetailForCurrentYear)

                        <div class="lead">
                            <p class="text-decoration-dull d-inline-block mb-0">
                                <strong>{{$psip->psipDetailForCurrentYear?$psip->psipDetailForCurrentYear->financial_year:$financial_year}} Project Activities for {{$psip->code}}</strong>
                            </p>
                            <div class="dropdown d-inline-block" id ="tutorial-details-1-ns">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="bi bi-three-dots" style="font-size: 1.3rem;color: cornflowerblue;"></i>
                             </button>
                             <ul class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#psNoteModal">Add PS Note</a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#screeningBriefModal">Add Screening Brief</a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#achievementReportModal">Add Achievment Report</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addActivityModal"  class="dropdown-item">Add New Activity</a>
                                <a href="{{ route('activities.edit', $psip->id) }}" class="dropdown-item">Edit Activity Details</a>
                            </ul>
                        </div>
                    </div>

                    <br>
                    <div class="accordion" id="accordionMainDoc">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading_main">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_main" aria-expanded="true" aria-controls="collapse_main" id ="tutorial-details-3-ns">
                                    Main Project Documents - PS Note, Screening Brief, Achievement Reports.
                                </button>
                            </h2>
                            <div id="collapse_main" class="accordion-collapse collapse" aria-labelledby="heading_main" data-bs-parent="#accordionMainDoc">
                                <div class="accordion-body">
                                    <div class="list-group">
                                        @foreach($psip->screeningBriefs as $key=>$screeningbrief)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"  >
                                                <div class="ms-2 me-auto" style="width: 100%;">
                                                    <a href="{{$screeningbrief->filepath? asset('storage/'.$screeningbrief->filepath):'#'}}"  target="_blank" style="display: block; text-decoration: none; color: black; width: 90%;">
                                                        Screening Brief{{$screeningbrief->file_name? ' - '.$screeningbrief->file_name:''}}<small class="text-muted">{{$screeningbrief->created_at? ' - Upload Date: '.$screeningbrief->created_at->format('d-m-Y'):''}}</small>
                                                    </a>
                                                </div>
                                        </li>
                                        @endforeach
                                        @foreach($psip->psNotes as $key=>$psnote)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"  >
                                                <div class="ms-2 me-auto" style="width: 100%;">
                                                    <a href="{{$psnote->filepath? asset('storage/'.$psnote->filepath):'#'}}"  target="_blank" style="display: block; text-decoration: none; color: black; width: 90%;">
                                                        PS Note{{$psnote->file_name? ' - '.$psnote->file_name:''}}<small class="text-muted">{{$psnote->created_at? ' - Upload Date: '.$psnote->created_at->format('d-m-Y'):''}}</small>
                                                    </a>
                                                </div>
                                        </li>
                                        @endforeach
                                        @foreach($psip->achievementReports as $key=>$a_report)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"  >
                                                <div class="ms-2 me-auto" style="width: 100%;">
                                                    <a href="{{$a_report->filepath? asset('storage/'.$a_report->filepath):'#'}}"  target="_blank" style="display: block; text-decoration: none; color: black; width: 90%;">
                                                        Achievement Report{{$a_report->file_name? ' - '.$a_report->file_name:''}}<small class="text-muted">{{$a_report->created_at? ' - Upload Date: '.$a_report->created_at->format('d-m-Y'):''}}</small>
                                                    </a>
                                                </div>
                                        </li>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="container-fluid mt-4 px-0" id ="tutorial-details-4-ns">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Activity Overview</h5>
                            <div>
                                <label class="form-check-label me-2" for="viewToggleSwitch">Toggle View:</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="viewToggleSwitch" onchange="toggleView()">
                                </div>
                            </div>
                        </div>
                        <!-- Table View -->
                        <div id="tableView" class="view-section  d-none">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Activity Name</th>
                                            <th>Associated Documents</th>
                                            <th>Options/Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($activities as $activity)
                                            <tr>
                                                <td>{{ $activity->activity_name }}</td>
                                                <td>
                                                    @if($activity->psipDocs->count() > 0)

                                                            @foreach($activity->psipDocs as $doc)
                                                                <li class="text-decoration-dull-blue"><a href="{{ $doc->filepath }}" target="_blank" class="text-decoration-dull-blue" style="text-decoration: none">{{ $doc->doc_title }}</a></li>
                                                            @endforeach



                                                    @else
                                                        <em>No documents available</em>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $activity->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical" style="font-size: 1.4rem; color: cornflowerblue;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#documentModal" class="dropdown-item">Document Checklist</a>
                                                            <a href="{{ route('psipupload.create', $activity->id) }}" class="dropdown-item text-primary">Upload Document <i class="bi bi-upload text-primary"></i></a>
                                                            <a href="{{ route('psipupload.organize', $activity->id) }}" class="dropdown-item" target="_blank">Organize Documents</a>
                                                            <a href="{{ route('activityphoto.upload', $activity->id) }}" class="dropdown-item" target="_blank">View/Upload Photos For This Activity</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#" class="dropdown-item">View Completion Status Of This Activity</a>
                                                            @if((auth()->user()->divisions_id == 15 || auth()->user()->id == 2))
                                                            <div class="dropdown-divider"></div>
                                                            <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#activitySurpressModal" onclick="setSurpesssActivityId({{ $activity->id }})">
                                                                Suppress this activity
                                                                <i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#activityRemoveModal" onclick="setRemoveActivityId({{ $activity->id }})">
                                                                Remove this activity
                                                                <i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                            </button>
                                                            {{-- <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#">
                                                                Set activity as completed
                                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                            </button> --}}
                                                            @if($activity->processInstance && $activity->processInstance->currentStep)
                                                                <li>
                                                                    <button class="dropdown-item text-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#advanceStepModal"
                                                                        data-instance-id="{{ $activity->processInstance->id }}"
                                                                        data-step-name="{{ $activity->processInstance->currentStep->name }}"
                                                                        data-step-description="{{ $activity->processInstance->currentStep->description }}"
                                                                        data-conditions='@json($activity->processInstance->currentStep->conditions->map(fn($c) => ["type" => class_basename($c->type), "parameter" => $c->parameter]))'
                                                                        data-actions='@json($activity->processInstance->currentStep->actions->map(fn($a) => ["type" => class_basename($a->type), "parameter" => $a->parameter]))'>
                                                                        Advance Step <i class="bi bi-forward-fill text-success"></i>
                                                                    </button>
                                                                </li>
                                                            @endif

                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No activities available for this financial year</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Accordian View -->
                        <div id="accordionView" class="accordion">
                            @foreach($activities as $key => $b)

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$key}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}" onclick="fetchDocTypeDivisions({{$b['id']}})">
                                       {{$b->activity_name}} - Documents
                                   </button>

                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- remember divisions is incorrectly spelt in the database -->
                                        @if((auth()->user()->divisions_id == $psip->division_id) || auth()->user()->divisions_id == 15 ||auth()->user()->id==2)

                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="d-flex align-items-center"> <!-- This div wraps the upload button and document dropdown together -->
                                                <a href="{{ route('psipupload.create', $b->id) }}" class="btn btn-primary btn-sm me-2"><i class="bi bi-upload"></i> Upload Document</a>
                                                <select id="docGroupDropdown" class="form-select form-select-sm me-2 docGroupDropdown">
                                                    <option value="">Folder Select - All</option>
                                                    @foreach($docGroups as $docGroup)
                                                    <option value="{{$docGroup->id}}">{{$docGroup->group_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="activeFilters" class="activeFilters"></div>
                                            </div>
                                            <div class="dropdown"> <!-- This div is for the dropdown, which will be aligned to the right -->
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton9" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical" style="font-size: 1.4rem; color: cornflowerblue;"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#documentModal" class="dropdown-item"> Document Checklist</a>
                                                    <a href="{{ route('psipupload.create', $b->id) }}" class="dropdown-item text-primary">Upload Document <i class="bi bi-upload text-primary"></i></a>
                                                    <a href="{{ route('psipupload.organize', $b->id) }}" class="dropdown-item" target="_blank">Organize Documents</a>
                                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#" class="dropdown-item">Add Photos To This Activity</a> -->
                                                    <a href="{{ route('activityphoto.upload', $b->id) }}" class="dropdown-item" target="_blank">View/Upload Photos For This Activity</a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#" class="dropdown-item">View Completion Status Of This Activity</a>
                                                    @if((auth()->user()->divisions_id == 15 || auth()->user()->id == 2))
                                                        <div class="dropdown-divider"></div>
                                                        <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#activitySurpressModal" onclick="setSurpesssActivityId({{$b['id']}})">
                                                            Suppress this activity
                                                            <i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#activityRemoveModal" onclick="setRemoveActivityId({{$b['id']}})">
                                                            Remove this activity
                                                            <i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                        </button>
                                                        {{-- <button class="btn btn-danger btn-sm dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#" >
                                                            Set activity as completed
                                                            <i class="bi bi-check-circle-fill text-success"></i>
                                                        </button> --}}

                                                        @if($b->processInstance && $b->processInstance->currentStep)
                                                                <li>
                                                                    <button class="dropdown-item text-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#advanceStepModal"
                                                                        data-instance-id="{{ $b->processInstance->id }}"
                                                                        data-step-name="{{ $b->processInstance->currentStep->name }}"
                                                                        data-step-description="{{ $b->processInstance->currentStep->description }}"
                                                                        data-conditions='@json($b->processInstance->currentStep->conditions->map(fn($c) => ["type" => class_basename($c->type), "parameter" => $c->parameter]))'
                                                                        data-actions='@json($b->processInstance->currentStep->actions->map(fn($a) => ["type" => class_basename($a->type), "parameter" => $a->parameter]))'>
                                                                        Advance Step <i class="bi bi-forward-fill text-success"></i>
                                                                    </button>
                                                                </li>
                                                            @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>



                                        <div class="list-group">
                                            @foreach($b->documents as $document)<!-- c == psipdoc -->
                                            <!-- <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-start"> -->
                                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" data-doc-group-id="{{$document->doc_group_id}}" >
                                                <div class="ms-2 me-auto" style="width: 100%;">
                                                    <a href="{{$document->filepath? asset('storage/'.$document->filepath):'#'}}"  target="_blank" style="display: block; text-decoration: none; color: black; width: 90%;">
                                                        {{$document->docType->doc_type_name}}{{$document->doc_title? ' - '.$document->doc_title:''}}
                                                    </a>
                                                </div>

                                                <div class="dropdown">
                                                    <button class="btn btn-light" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical" style="font-size: 1.1rem; color: cornflowerblue;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#documentDetailsModal{{$document->id}}" onclick="setUpdateDocId({{$document['id']}},{{$b['id']}})" class="dropdown-item">View/Edit Document Details</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateDocumentModal" onclick="setUpdateDocId({{$document['id']}},{{$b['id']}})" class="dropdown-item">Update Document(Replaces This Current Document)</a>
                                                            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#" class="dropdown-item">Edit Document Details</a> --}}

                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <!-- document details modal -->

                                            @include('options.doc_details')
                                            @endforeach
                                        </div>
                                        @else
                                        <p>Sorry you cannot view this data.</p>
                                        @endif
                                        </div>
                                </div>


                            </div>

                            @endforeach
                        </div>
                    </div>

                @else
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            No details found
                        </p>

                    </div>
                </div>
                @endif
            </div>
        </div><hr>
    </div>
</div>
</div>
</div>

</div>
