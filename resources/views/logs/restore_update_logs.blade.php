@extends('layouts.app-master')

@section('content')

    <h2>Restore Updated Records</h2>
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
                <th>Updated By</th>
                <th>Updated At</th>
                <th>Previous Data</th>
                <th>Changed Data</th>
                <th>Restore</th>
            </tr>
        </thead>
        <tbody>
            @foreach($updateLogs as $log)
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
                    @if($log->changed_data)
                        <pre>{{ json_encode(json_decode($log->changed_data), JSON_PRETTY_PRINT) }}</pre>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('logs.restore_update', $log->id) }}">
                        @csrf
                        <button class="btn btn-primary" type="submit">Restore Previous State</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $updateLogs->links() }}

@endsection

