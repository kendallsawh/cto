@extends('layouts.app-master')

@section('content')

    <h2>All Model Changes Logs</h2>
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
                <th>Action</th>
                <th>Changed By</th>
                <th>Change Date</th>
                <th>Previous Data</th>
                <th>Changed Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allLogs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ ucfirst($log->action) }}</td>
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
                    @if($log->changed_data)
                        <pre>{{ json_encode(json_decode($log->changed_data), JSON_PRETTY_PRINT) }}</pre>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $allLogs->links() }}

@endsection
