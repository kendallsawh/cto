<!-- document details modals -->
                                        <div class="modal fade" id="documentDetailsModal{{$document->id}}" tabindex="-1" aria-labelledby="documentDetailsModalLabel{{$document->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="documentDetailsModalLabel{{$document->id}}">Document Details</h4>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                    </div>
                                                    <div class="">

                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Here you can view and edit the document details.</p>
                                                        {{-- enctype="multipart/form-data" --}}
                                                        <form class="" method="POST" action="{{ route('psipdocument.updatedetails') }}" enctype="multipart/form-data" >
                                                            @csrf
                                                            <input type="text" name="update_doc_id" id="update_doc_id" value="{{$document->id}}" style="display: none" >
					                                        <input type="text" name="update_activity_doc_id" id="update_activity_doc_id" value="{{$b->id}}" style="display: none">
                                                            <label for="title" class="form-label">Document Title</label>
                                                            <input value="{{$document->doc_title? $document->doc_title:null}}"
                                                                type="text"
                                                                class="form-control"
                                                                name="title"
                                                                placeholder="No title submitted" required>

                                                            @if ($errors->has('title'))
                                                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                                            @endif
                                                            {{-- <h5>Document type</h5>
                                                            <p>{{$document->docType->doc_type_name}}</p> --}}

                                                            {{-- <h5>Document Title/Name</h5>
                                                            <p id="docName">{{$document->doc_title? $document->doc_title:'No title submitted'}}</p> --}}
                                                            <label for="doc_type" class="form-label">Document Type</label>

                                                            <select id="doc_type" name="doc_type" class="form-control dropdown" required>
                                                                <option disabled="" selected=""></option>
                                                                @foreach($doctypes as $doc_type)
                                                                <option value="{{$doc_type->id}}" {{$document->doc_types_id==$doc_type->id ? 'selected' : '' }}>{{$doc_type->doc_type_name}}</option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('doc_type'))
                                                                <span class="text-danger text-left">{{ $errors->first('doc_type') }}</span>
                                                            @endif

                                                            {{-- <h5>Document Details/Description</h5>
                                                            <p id="docDetails">{{$document->docType->description? $document->docType->description:'No details submitted'}}</p> --}}
                                                            <label for="description" class="form-label">Descriptions</label>
                                                            <textarea class="form-control" name="description" placeholder="No details submitted" required>{{ $document->description ? $document->description : '' }}</textarea>


                                                            @if ($errors->has('description'))
                                                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                                            @endif
                                                            <hr>

                                                            <label for="description" class="form-label"><strong>Upload Date</strong></label>
                                                            <p id="docCreatedAt">{{$document->created_at? $document->created_at:'No data'}}</p>

                                                            {{-- <label for="docPreviousDoc" class="form-label"><strong>Additional Information</strong></label>
                                                            <p id="docPreviousDoc">{{$document->previous_doc_id? 'This document replaced a previous document.':''}}</p>
                                                            <p id="docUplodedBy">Uploaded by: {{$document->createdBy->name}}</p>
                                                            <p id="docUplodedBy">Document reference ID: {{$document->id}}</p> --}}
                                                            <label for="docPreviousDoc" class="form-label"><strong>Additional Information</strong></label>
                                                            <ul class="list-unstyled">
                                                                <li id="docPreviousDoc">{{$document->previous_doc_id ? 'This document replaced a previous document.' : ''}}</li>
                                                                <li id="docUploadedBy">Uploaded by: {{$document->createdBy->name}}</li>
                                                                <li id="docReferenceId">Document reference ID: {{$document->id}}</li>
                                                                <li id="lastupdated">Last updated: {{$document->updated_at}}</li>
                                                            </ul>

                                                            <hr>

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
