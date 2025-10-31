@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}" class="form-signin mx-auto shadow-lg p-4" style="max-width: 400px; border-radius: 8px;">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="text-center mb-4">
            <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Login</h1>
        </div>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" style="border-radius: 30px;">Login</button>

        @include('auth.partials.copy')
    </form>

    <style>
        body {
            background-color: #f8f9fa; /* Light background for better contrast */
        }
        .form-signin {
            background-color: white;
        }
        .form-control {
            border-radius: 5px;
            padding: 12px;
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-2px); /* Subtle lift effect */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Add some depth */
        }
    </style>
@endsection
