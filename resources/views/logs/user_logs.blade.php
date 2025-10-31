@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Logs for User: {{ $user->name }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model Type</th>
                <th>Action</th>
                <th>Change Date</th>
                <th>Previous Data</th>
                <th>Changed Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ ucfirst($log->action) }}</td>
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
    {{ $logs->links() }}
</div>
@endsection
