<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class IndividualRegistrationController extends Controller
{
    /**
     * Show the individual registration form.
     */
    public function create(): View
    {
        return view('auth.individual-register');
    }

    /**
     * Handle an incoming individual registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'national_id' => ['nullable', 'string', 'max:191', 'required_without:passport', 'unique:individuals,national_id'],
            'passport' => ['nullable', 'string', 'max:191', 'required_without:national_id', 'unique:individuals,passport'],
            'tt_biz_id' => ['nullable', 'string', 'max:191'],
            'address_lot_apt' => ['nullable', 'string', 'max:191'],
            'address_street' => ['required', 'string', 'max:191'],
            'address_town' => ['required', 'string', 'max:191'],
            'contact_business' => ['required', 'string', 'max:191'],
            'contact_mobile' => ['nullable', 'string', 'max:191'],
        ], [
            'national_id.required_without' => 'Please provide either a National ID or Passport number.',
            'passport.required_without' => 'Please provide either a Passport number or National ID.',
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'username' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole(5);

            $user->individual()->create([
                'national_id' => $validated['national_id'] ?? null,
                'passport' => $validated['passport'] ?? null,
                'tt_biz_id' => $validated['tt_biz_id'] ?? null,
                'address_lot_apt' => $validated['address_lot_apt'] ?? null,
                'address_street' => $validated['address_street'],
                'address_town' => $validated['address_town'],
                'contact_business' => $validated['contact_business'],
                'contact_mobile' => $validated['contact_mobile'] ?? null,
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('home.index');
    }
}
