<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth\AuthManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\AdUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    // public function login(LoginRequest $request)
    // {
    //     $credentials = $request->getCredentials();

    //     if(!Auth::validate($credentials)):
    //         return redirect()->to('login')
    //             ->withErrors(trans('auth.failed'));
    //     endif;

    //     $user = Auth::getProvider()->retrieveByCredentials($credentials);

    //     Auth::login($user);

    //     return $this->authenticated($request, $user);
    // }


    public function login(LoginRequest $request)
    {
        $credentials = [
            'samaccountname' => $request->username, // LDAP username field
            'password' => $request->password,
        ];

        try {
            auth()->setDefaultDriver('adyuser'); // Set LDAP driver
            $conn = \LdapRecord\Container::getDefaultConnection();
            $conn->connect();

            $temp = User::where('username', $request->username)->first(); // Check if user exists in the database

            if (Auth::attempt($credentials)) { // Authenticate using LDAP
                $user = Auth::user();
                $temp2 = DB::table('model_has_roles')->where('model_id', $user->id)->first();

                if ($temp == null || $temp2 == null) { // Assign role if first login
                    $new_arr = ['role_id' => 3, 'model_type' => "App\\Models\\User", 'model_id' => $user->id];

                    auth()->setDefaultDriver('web'); // Switch back to the default driver
                    DB::table('model_has_roles')->insert($new_arr); // Assign role
                } else { // User has logged in before
                    auth()->setDefaultDriver('web');
                }

                Auth::login($user);
                return $this->authenticated($request, $user);
            }
        } catch (\LdapRecord\Auth\BindException $e) {
            Log::error('LDAP BindException: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Error during LDAP authentication: ' . $e->getMessage());
        }

        // Fallback to database authentication
        auth()->setDefaultDriver('web');

        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) {
            return redirect()->to('login')->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }



    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
