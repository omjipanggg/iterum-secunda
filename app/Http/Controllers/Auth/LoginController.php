<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RealRashid\SweetAlert\Facades\Alert;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo() {
        if (auth()->user()->hasRole(1)) { return 'master'; }
        else if (auth()->user()->hasRole(7)) { return 'profile'; }
        else if (auth()->user()->hasRole(8)) { return 'partner'; }
        else { return RouteServiceProvider::HOME; }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function login(Request $request) {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            \Log::create('Login');
            $request->session()->regenerateToken();
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function logout(Request $request) {
        if ($this->guard()->check()) {
            \Log::create('Logout');
            $this->guard()->logout();
        }

        $request->session()->invalidate();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->route('home.index');
    }

    protected function loggedOut(Request $request) {
        alert()->success('Terima kasih', 'Sesi Anda telah berakhir.');
        return redirect()->route('home.index');
    }
}
