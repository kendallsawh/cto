@extends('layouts.auth-master')

@section('content')
    @include('layouts.partials.messages')
    <form method="post" action="{{ route('company.register') }}">
        @csrf

        <h1 class="h3 mb-4 fw-normal text-center">Company Registration</h1>

        <div class="mb-3 row align-items-center">
            <label for="name" class="col-md-4 col-form-label text-md-end">Full Name</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
            <div class="col-md-8">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
            <div class="col-md-8">
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
            <div class="col-md-8">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="company_name" class="col-md-4 col-form-label text-md-end">Company Name</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                @error('company_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="representative_name" class="col-md-4 col-form-label text-md-end">Representative Name</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ old('representative_name') }}" required>
                @error('representative_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="address_lot_apt" class="col-md-4 col-form-label text-md-end">Lot/Apt Number</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="address_lot_apt" name="address_lot_apt" value="{{ old('address_lot_apt') }}">
                @error('address_lot_apt')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="address_street" class="col-md-4 col-form-label text-md-end">Street Address</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="address_street" name="address_street" value="{{ old('address_street') }}" required>
                @error('address_street')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="address_town" class="col-md-4 col-form-label text-md-end">Town</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="address_town" name="address_town" value="{{ old('address_town') }}" required>
                @error('address_town')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="vat_number" class="col-md-4 col-form-label text-md-end">Company VAT Number</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ old('vat_number') }}">
                @error('vat_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="contact_business" class="col-md-4 col-form-label text-md-end">Business Phone</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="contact_business" name="contact_business" value="{{ old('contact_business') }}" required>
                @error('contact_business')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4 row align-items-center">
            <label for="contact_mobile" class="col-md-4 col-form-label text-md-end">Mobile Phone</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="contact_mobile" name="contact_mobile" value="{{ old('contact_mobile') }}">
                @error('contact_mobile')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-lg btn-primary px-5" type="submit">Register</button>
        </div>
    </form>
@endsection
