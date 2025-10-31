<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'samaccountname' => $request->username,
            'password' => $request->password,
        ];

        try {
            auth()->setDefaultDriver('adyuser');
            $conn = \LdapRecord\Container::getDefaultConnection();
            $conn->connect();

            $temp = User::where('username', $request->username)->first();

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $temp2 = DB::table('model_has_roles')->where('model_id', $user->id)->first();

                if ($temp === null || $temp2 === null) {
                    $new_arr = ['role_id' => 3, 'model_type' => "App\\Models\\User", 'model_id' => $user->id];

                    auth()->setDefaultDriver('web');
                    DB::table('model_has_roles')->insert($new_arr);
                } else {
                    $user = Auth::user();
                    auth()->setDefaultDriver('web');
                }

                Auth::login($user);

                if ($response = $this->authenticated($request, $user)) {
                    return $response;
                }

                return redirect()->intended($this->redirectPath());
            }
        } catch (ModelNotFoundException $e) {
            Log::info($e);
        }

        auth()->setDefaultDriver('web');
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) {
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        if ($response = $this->authenticated($request, $user)) {
            return $response;
        }

        return redirect()->intended($this->redirectPath());
    }
}
