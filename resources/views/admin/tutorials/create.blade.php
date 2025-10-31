@extends('layouts.app-master')

@section('content')
    <h1>Create Tutorial Step</h1>
    <form action="{{ route('admin.tutorials.store') }}" method="POST">
        @csrf
        <div>
            <label for="tutorial_name">Tutorial Name:</label>
            <input type="text" name="tutorial_name" id="tutorial_name" value="{{ old('tutorial_name') }}" required>
        </div>
        <div>
            <label for="selector">Selector:</label>
            <input type="text" name="selector" id="selector" value="{{ old('selector') }}" required>
        </div>
        <div>
            <label for="text">Text:</label>
            <textarea name="text" id="text" required>{{ old('text') }}</textarea>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
