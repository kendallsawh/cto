@extends('layouts.app-master')

@section('content')
@auth
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@include('layouts.partials.messages')


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
    <div class="bg-light p-5 rounded">

        <h1>Add a document to the current list of documents</h1>
        <p class="lead">Only authenticated users can access this section.</p>

    </div>

    <div class="bg-light p-4 rounded">


        <div class="container mt-4">

            <form method="POST" action="{{ route('add.document.to.database.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="doc_name" class="form-label">Document Name/Type</label>
                    <input value="{{ old('doc_name') }}"
                        type="text"
                        class="form-control"
                        name="doc_name"
                        required>

                    @if ($errors->has('doc_name'))
                        <span class="text-danger text-left">{{ $errors->first('doc_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="user_group" class="form-label">Optional - select notification group(s). When selected, users belongning these groups will be notified when changes are made to documents of this type if it is uploaded to a PSIP.</label>
                    <div id="user_group">
                        @foreach($user_groups as $user_group)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="user_group[]" value="{{$user_group->id}}" id="user_group_{{$user_group->id}}" {{is_array(old('user_group')) && in_array($user_group->id, old('user_group')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="user_group_{{$user_group->id}}">
                                {{$user_group->group_name}}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    @if ($errors->has('user_group'))
                    <span class="text-danger text-left">{{ $errors->first('user_group') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('home.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>

    </div>

    <div class="bg-light p-5 rounded">


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
