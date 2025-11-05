@extends('layouts.auth-master')

@section('content')
    <div class="container py-5">
        @include('layouts.partials.messages')
        <form method="post" action="{{ route('company.register') }}" class="mx-auto shadow-lg bg-white p-4 p-md-5" style="max-width: 720px; border-radius: 12px;">
            @csrf

            <div class="text-center mb-4">
                <img class="mb-3" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">
                <h1 class="h3 fw-normal mb-1">Company Registration</h1>
                <p class="text-muted mb-0">Create your company account to get started.</p>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <h2 class="h5 text-primary border-bottom pb-2">Account Information</h2>
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 pt-3">
                    <h2 class="h5 text-primary border-bottom pb-2">Company Details</h2>
                </div>
                <div class="col-12">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                    @error('company_name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="representative_name" class="form-label">Representative Name</label>
                    <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ old('representative_name') }}" required>
                    @error('representative_name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="vat_number" class="form-label">Company VAT Number</label>
                    <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ old('vat_number') }}">
                    @error('vat_number')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="tt_biz_id" class="form-label">TT-Biz ID <span class="text-muted small">(Optional)</span></label>
                    <input type="text" class="form-control" id="tt_biz_id" name="tt_biz_id" value="{{ old('tt_biz_id') }}" placeholder="Enter your TT-Biz ID if applicable">
                    <span class="form-text">Provide this only if your business has been issued a TT-Biz ID.</span>
                    @error('tt_biz_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 pt-3">
                    <h2 class="h5 text-primary border-bottom pb-2">Address</h2>
                </div>
                <div class="col-12 col-md-6">
                    <label for="address_lot_apt" class="form-label">Lot/Apt Number</label>
                    <input type="text" class="form-control" id="address_lot_apt" name="address_lot_apt" value="{{ old('address_lot_apt') }}">
                    @error('address_lot_apt')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="address_street" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="address_street" name="address_street" value="{{ old('address_street') }}" required>
                    @error('address_street')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="address_town" class="form-label">Town</label>
                    <input type="text" class="form-control" id="address_town" name="address_town" value="{{ old('address_town') }}" required>
                    @error('address_town')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 pt-3">
                    <h2 class="h5 text-primary border-bottom pb-2">Contact Information</h2>
                </div>
                <div class="col-12 col-md-6">
                    <label for="contact_business" class="form-label">Business Phone</label>
                    <input type="text" class="form-control" id="contact_business" name="contact_business" value="{{ old('contact_business') }}" required>
                    @error('contact_business')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="contact_mobile" class="form-label">Mobile Phone</label>
                    <input type="text" class="form-control" id="contact_mobile" name="contact_mobile" value="{{ old('contact_mobile') }}">
                    @error('contact_mobile')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-lg btn-primary px-5" type="submit" style="border-radius: 30px;">Register</button>
            </div>

            @include('auth.partials.copy')
        </form>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-control {
            border-radius: 5px;
            padding: 12px;
        }

        .btn-primary {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
