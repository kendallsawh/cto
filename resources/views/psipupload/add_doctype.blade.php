{{-- @extends('layouts.app-master')

@section('content')
@auth
@include('layouts.partials.messages') --}}




<div class="modal fade" id="addDocTypeModal" tabindex="-1" aria-labelledby="addDocTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Add Document Type</h4> --}}

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="">

            </div>

            <div class="modal-body">

    <div class="bg-light p-5 rounded">

        <h1>Add a document to the current list of documents</h1>
      

    </div>

    <div class="bg-light p-4 rounded">


        <div class="container mt-4">

            <form method="POST" action="{{ route('doctype.add.to.database') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="activity" id="activity" value="{{$activity->id}}" style="display: none;">
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


                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('home.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>

    </div>

    <div class="bg-light p-5 rounded">


    </div>
</div>
</div>
</div>
</div> 
 
{{-- @endauth
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

    @endsection --}}
