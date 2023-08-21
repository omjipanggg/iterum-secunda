<?php

namespace App\Http\Controllers\Auth;

use App\Models\Candidate;
use App\Models\Profile;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required'],
            'g-recaptcha-response' => ['recaptcha', 'required'],
        ], [
            'g-recaptcha-response.required' => 'Mohon centang kolom yang tersedia.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => Str::lower($data['email']),
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach($data['type'], ['expired_date' => Carbon::now()->addMonths(12)]);

        return $user;
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $profile = Profile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'primary_email' => $request->email,
        ]);

        event(new Registered($user));

        $this->guard()->login($user);

        if ($request->type == 7) {
            Candidate::create(['profile_id' => $profile->id]);
        } else if ($request->type == 8) {
            Employee::create(['profile_id' => $profile->id]);
        } else {}

        return $this->registered($request, $user);
    }

    public function registered(Request $request, $user) {
        if ($this->guard()->check()) {
            \Log::create('Register');
            $this->guard()->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::info('Pendaftaran Sukses', 'Mohon aktivasi akun Anda melalui email.')->autoClose(false);
        return redirect($this->redirectPath())->with('status', 'unverified');
    }
}
