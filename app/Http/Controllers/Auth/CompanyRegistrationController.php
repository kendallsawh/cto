<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyRegistrationController extends Controller
{
    /**
     * Display the company registration form.
     */
    public function create()
    {
        return view('auth.company-register');
    }

    /**
     * Handle an incoming registration request for a company.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'company_name' => ['required', 'string', 'max:191'],
            'representative_name' => ['required', 'string', 'max:191'],
            'address_street' => ['required', 'string', 'max:191'],
            'address_town' => ['required', 'string', 'max:191'],
            'vat_number' => ['nullable', 'string', 'max:191', 'unique:companies,vat_number'],
            'contact_business' => ['required', 'string', 'max:191'],
            'address_lot_apt' => ['nullable', 'string', 'max:191'],
            'contact_mobile' => ['nullable', 'string', 'max:191'],
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $companyData = [
            'company_name' => $validated['company_name'],
            'representative_name' => $validated['representative_name'],
            'address_lot_apt' => $validated['address_lot_apt'] ?? null,
            'address_street' => $validated['address_street'],
            'address_town' => $validated['address_town'],
            'vat_number' => $validated['vat_number'] ?? null,
            'contact_business' => $validated['contact_business'],
            'contact_mobile' => $validated['contact_mobile'] ?? null,
        ];

        $user = DB::transaction(function () use ($userData, $companyData) {
            /** @var \App\Models\User $user */
            $user = User::create($userData);
            $user->assignRole(5);
            $user->company()->create($companyData);

            return $user;
        });

        Auth::login($user);

        return redirect('/dashboard');
    }
}
