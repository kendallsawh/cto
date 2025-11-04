@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Registration</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('company.register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="191" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="representative_name" class="form-label">Representative Name</label>
                            <input id="representative_name" type="text" class="form-control" name="representative_name" value="{{ old('representative_name') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="address_lot_apt" class="form-label">Lot/Apt Number</label>
                            <input id="address_lot_apt" type="text" class="form-control" name="address_lot_apt" value="{{ old('address_lot_apt') }}" maxlength="191">
                        </div>

                        <div class="mb-3">
                            <label for="address_street" class="form-label">Street</label>
                            <input id="address_street" type="text" class="form-control" name="address_street" value="{{ old('address_street') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="address_town" class="form-label">Town</label>
                            <input id="address_town" type="text" class="form-control" name="address_town" value="{{ old('address_town') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="vat_number" class="form-label">Company VAT Number</label>
                            <input id="vat_number" type="text" class="form-control" name="vat_number" value="{{ old('vat_number') }}" maxlength="191">
                        </div>

                        <div class="mb-3">
                            <label for="contact_business" class="form-label">Business Phone</label>
                            <input id="contact_business" type="text" class="form-control" name="contact_business" value="{{ old('contact_business') }}" maxlength="191" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_mobile" class="form-label">Mobile Phone</label>
                            <input id="contact_mobile" type="text" class="form-control" name="contact_mobile" value="{{ old('contact_mobile') }}" maxlength="191">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
