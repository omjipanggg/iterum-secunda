<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ActivityLog;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify($id) {
        $user = User::find($id);

        if (!empty($user->email_verified_at)) {
            Alert::error('Kesalahan', 'Aktivasi akun sudah dilakukan pada ' . date_time_indo_format($user->email_verified_at))->autoClose(false);
            return redirect()->route('home.index');
        }

        $user->email_verified_at = now();
        $user->save();

        if (Auth::check()) {
            ActivityLog::create('Verified');
            Auth::logout();
        }

        Auth::login($user);
        Alert::success('Sukses', 'Akun Anda berhasil diaktivasi.');

        if ($user->hasRole(1)) {
            return redirect()->route('master.index');
        } else if ($user->hasRole(2)) {
            return redirect()->route('home.lounge');
        } else if ($user->hasRole(7)) {
            return redirect()->route('candidate.profile');
        } else if ($user->hasRole(8)) {
            return redirect()->route('partner.index');
        } else {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('home.index');
    }
}
