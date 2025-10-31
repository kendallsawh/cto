@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Deleted Records</h2>
    <form action="{{ route('logs.search') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="username">Search Logs by User Name:</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter user name" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model Type</th>
                <th>Model ID</th>
                <th>Deleted By</th>
                <th>Deleted At</th>
                <th>Previous Data</th>
                <th>Restore</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedLogs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ $log->model_id }}</td>
                <td>
                    <a href="{{ route('logs.user', $log->user_id) }}">
                        {{ optional($log->user)->name ?? 'N/A' }}
                    </a>
                </td>

                <td>{{ $log->created_at }}</td>
                <td>
                    @if($log->previous_data)
                        <pre>{{ json_encode(json_decode($log->previous_data), JSON_PRETTY_PRINT) }}</pre>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('logs.restore', $log->id) }}">
                        @csrf
                        <button class="btn btn-primary" type="submit">Restore</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $deletedLogs->links() }}
</div>
@endsection

