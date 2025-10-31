@extends('layouts.app-master')

@section('content')
<div class="container mt-4">
    <h2>Edit Flow: {{ $flow->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('process_builder.update', $flow) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Flow Name</label>
            <input type="text" name="name" value="{{ $flow->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $flow->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('process_builder.index') }}" class="btn btn-secondary">Back</a>
    </form>

    <hr>
    <h4>Steps</h4>
    <a href="{{ route('process_builder.steps.create', $flow) }}" class="btn btn-primary mb-2">Add Step</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order</th>
                <th>Name</th>
                <th>Conditions</th>
                <th>Actions</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flow->steps->sortBy('order') as $step)
            <tr>
                <td>{{ $step->order }}</td>
                <td>{{ $step->name }}</td>
                <td>{{ $step->conditions->count() }}</td>
                <td>{{ $step->actions->count() }}</td>
                <td>
                    <a href="{{ route('process_builder.steps.edit', $step) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('process_builder.steps.destroy', $step) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this step?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
<h5>Reorder Steps</h5>

<ul id="step-sortable" class="list-group mb-3">
    @foreach($flow->steps->sortBy('order') as $step)
        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $step->id }}">
            <span>
                <i class="bi bi-grip-vertical me-2"></i> {{ $step->name }}
            </span>
            <small class="text-muted">Order: {{ $step->order }}</small>
        </li>
    @endforeach
</ul>

<button id="save-order" class="btn btn-primary">Save Order</button>
<div id="order-feedback" class="mt-2"></div>

</div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const list = document.getElementById('step-sortable');
        Sortable.create(list, {
            animation: 150
        });

        document.getElementById('save-order').addEventListener('click', () => {
            const ids = Array.from(list.children).map(li => li.dataset.id);
            fetch("{{ route('process_builder.steps.reorder', $flow) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ order: ids })
            })
            .then(response => response.json())
            .then(data => {
                const box = document.getElementById('order-feedback');
                box.innerText = data.message;
                box.className = 'alert alert-success';
            })
            .catch(() => {
                const box = document.getElementById('order-feedback');
                box.innerText = 'Error saving order.';
                box.className = 'alert alert-danger';
            });
        });
    });
    </script>

@endsection
