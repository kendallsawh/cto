@extends('layouts.app-master')

@section('content')
<div class="container mt-4">
    <h2>Create Process Flow</h2>

    <form method="POST" action="{{ route('process_builder.store') }}">
        @csrf
        <div class="mb-3">
            <label>Flow Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Model Type</label>
            <select name="model_type" class="form-select" required>
                <option value="App\Models\Activity">Activity</option>
                <option value="App\Models\PsipName">PsipName</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Model ID</label>
            <input type="number" name="model_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('process_builder.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
