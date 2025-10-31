@extends('layouts.app-master')

@section('content')
    <h1>Tutorial Steps</h1>
    <a href="{{ route('admin.tutorials.create') }}" class="btn btn-primary">Create New Tutorial Step</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tutorial Name</th>
                <th>Selector</th>
                <th>Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tutorials as $tutorial)
                <tr>
                    <td>{{ $tutorial->id }}</td>
                    <td>{{ $tutorial->tutorial_name }}</td>
                    <td>{{ $tutorial->selector }}</td>
                    <td>{{ $tutorial->text }}</td>
                    <td>
                        <a href="{{ route('admin.tutorials.edit', $tutorial->id) }}">Edit</a>
                        <form action="{{ route('admin.tutorials.destroy', $tutorial->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this tutorial step?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
