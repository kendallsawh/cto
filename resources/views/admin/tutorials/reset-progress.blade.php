@extends('layouts.app-master')

@section('content')
    <h1>Reset Tutorial Progress</h1>
    <p>Select the tutorial for which you want to reset progress for all users.</p>
    <form action="{{ route('admin.tutorials.resetProgress') }}" method="POST">
        @csrf
        <div>
            <label for="tutorial_name">Select Tutorial:</label>
            <select name="tutorial_name" id="tutorial_name" required>
                <option value="">-- Select Tutorial --</option>
                @foreach($tutorialNames as $tutorialName)
                    <option value="{{ $tutorialName }}">{{ ucfirst(str_replace('_', ' ', $tutorialName)) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" onclick="return confirm('Are you sure you want to reset progress for this tutorial? This will delete all progress entries and users will have to retake the updated tutorial.')">
            Reset Progress
        </button>
    </form>
@endsection
