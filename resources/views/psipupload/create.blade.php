@extends('layouts.app-master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@stop
@section('content')
@auth
@include('layouts.partials.messages')





    <div class="bg-light p-5 rounded">
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Attach a Document</h2>
        <div class="lead">
           To the activity name: {{$activity->activity_name}}
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('psipupload.store', $activity->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Document Title</label>
                    <input value="{{ old('title') }}"
                        type="text"
                        class="form-control"
                        name="title"
                        placeholder="Title" required>

                    @if ($errors->has('title'))
                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="doc_type" class="form-label">Document Type</label>

                    <div style="display: flex; align-items: center;">
                        <!-- Select Dropdown -->
                        <select id="doc_type" name="doc_type" class="form-control dropdown" required style="margin-right: 10px;">
                            <option disabled="" selected=""></option>
                            @foreach($doc_types as $doc_type)
                                <option value="{{$doc_type->id}}" {{old('doc_type')==$doc_type->id ? 'selected' : '' }}>
                                    {{$doc_type->doc_type_name}}
                                </option>
                            @endforeach
                        </select>


                        <!-- "Add" Button with "+" Icon -->
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target='#addDocTypeModal' title="Add a new document type to the list.">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="doc_group" class="form-label">Select a folder to upload to</label>

                    <select id="doc_group" name="doc_group" class="form-control dropdown">
                        <option disabled="" selected=""></option>
                        @foreach($doc_groups as $doc_group)
                        <option value="{{$doc_group->id}}" {{old('doc_group')==$doc_group->id ? 'selected' : '' }}>{{$doc_group->group_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('doc_group'))
                        <span class="text-danger text-left">{{ $errors->first('doc_group') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="file_upload" class="form-label">Document Upload</label>
                    <input class="form-control"
                        name="file_upload"
                        type="file"
                        placeholder="Document Type" required>

                    @if ($errors->has('file_upload'))
                        <span class="text-danger text-left">{{ $errors->first('file_upload') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea value="{{ old('description') }}"
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Provide further details about the document in this description box" required></textarea>

                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">Upload Document</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

    <div class="bg-light p-5 rounded">


    </div>

@include("psipupload.add_doctype")
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
