@extends('layouts.app-master')

@section('content')
    <h1>Edit Tutorial Step</h1>
    <form action="{{ route('admin.tutorials.update', $tutorial->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="tutorial_name">Tutorial Name:</label>
            <input type="text" name="tutorial_name" id="tutorial_name" value="{{ $tutorial->tutorial_name }}" required>
        </div>
        <div>
            <label for="selector">Selector:</label>
            <input type="text" name="selector" id="selector" value="{{ $tutorial->selector }}" required>
        </div>
        <div>
            <label for="text">Text:</label>
            <textarea name="text" id="text" required>{{ $tutorial->text }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
