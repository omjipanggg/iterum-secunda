<?php

namespace App\Http\Controllers\Auth;

use App\Models\Candidate;
use App\Models\Partner;
use App\Models\Profile;
use App\Models\Region;
use App\Models\RequestToken;
use App\Models\Role;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        ], ['g-recaptcha-response.required' => 'Mohon centang kolom yang tersedia.']);
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
            'password' => Hash::make($data['password'])
        ]);
        $user->roles()->attach($data['type'], ['expired_at' => Carbon::now()->addMonths(12)]);

        return $user;
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->guard()->login($user);

        $profile = Profile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'primary_email' => $request->email
        ]);

        if ($request->type == 2) {
            RequestToken::where('email', $request->email)->update([
                'department_name' => $request->department_name,
                'region_id' => $request->region_id,
                'user_id' => $user->id,
                'completed' => 1
            ]);
            $user->email_verified_at = Carbon::now();
            $user->save();
        } else if ($request->type == 7) {
            Candidate::create(['profile_id' => $profile->id]);
        } else if ($request->type == 8) {
            $each_word = Str::of($request->company_name)->explode(' ');
            $prefix = '';
            foreach ($each_word as $initial) {
                $prefix .= Str::upper($initial[0]);
            }
            Partner::create([
                'name' => $request->company_name,
                'prefix' => $prefix,
                'active' => 0,
                'status' => 0,
                'slug' => Str::slug($request->company_name),
                'person_in_charge' => $request->name,
                'phone_number' => $request->phone_number,
                'city_id' => $request->city_id,
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);
        } else {
            alert()->error('Kesalahan', 'Parameter tidak sesuai.');
            return redirect()->route('home.index');
        }

        return $this->registered($request, $user);
    }

    public function registered(Request $request, $user) {
        if ($request->type == 2) {
            alert()->info('Pendaftaran Sukses', 'Selamat bergabung di ' . config('app.name') . '™!');
            return redirect()->route('dashboard.index')->with('status', 'verified-on-demand');
        }

        if ($this->guard()->check()) {
            \Log::create('Register');
            $this->guard()->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        alert()->info('Pendaftaran Sukses', 'Mohon aktivasi akun Anda melalui email.')->autoClose(false);
        return redirect($this->redirectPath())->with('status', 'unverified');
    }

    public function createPartner() {
        return view('auth.register-as-partner');
    }

    public function createInternal(string $hash) {
        $data = RequestToken::where('hash', $hash)->first();

        if (!$data) {
            alert()->error('Kesalahan', 'Akses ditolak.');
            return redirect()->route('home.index');
        }

        if ($data && $data->completed) {
            alert()->warning('Perhatian', 'Token ini sudah Anda gunakan untuk mendaftar pada ' . $data->created_at->locale('id')->diffForHumans() . '.')->autoClose(false);
            return redirect()->route('home.index');
        }

        $regions = Region::where([
            ['code', '<>', '01'],
            ['code', '<>', '12'],
        ])->orderBy('code')
        ->get();

        $context = [
            'data' => $data,
            'regions' => $regions,
        ];

        return view('auth.register-on-demand', $context);
    }
}
