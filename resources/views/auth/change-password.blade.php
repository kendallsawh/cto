@extends('layouts.app-master')

@section('content')
@auth

    @include('layouts.partials.messages')
    <div class="container">
        <h2>Change Password</h2>
        <form action="{{ route('users.password.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
@endauth
@guest
    <div class="bg-light p-5 rounded">
        <h1>Access Denied</h1>
        <p class="lead">Please login to update your password.</p>
    </div>
@endguest
@endsection

@section("scripts")
<script type="text/javascript">
// Add any JavaScript here if needed.
</script>
@endsection
