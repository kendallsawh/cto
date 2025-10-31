@extends('layouts.app-master')

@section('content')
<div class="container mt-4">
    <h2>Process Flows</h2>

    <div class="mb-3">
        <a href="{{ route('process_builder.create') }}" class="btn btn-primary">Create New Flow</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Model</th>
                <th>Steps</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flows as $flow)
            <tr>
                <td>{{ $flow->name }}</td>
                <td>{{ class_basename($flow->model_type) }} #{{ $flow->model_id }}</td>
                <td>{{ $flow->steps_count }}</td>
                <td>
                    <a href="{{ route('process_builder.edit', $flow) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('process_builder.destroy', $flow) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this flow?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
