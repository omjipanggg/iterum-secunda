<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\City;
use App\Models\Education;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class RecruitmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    public function index() {
        $context = [];
    	return view('pages.recruitment.index', $context);
    }

    public function filter() {
        $availablity = [
            1 => 'SEGERA',
            2 => 'DALAM SATU MINGGU',
            3 => 'DALAM 1 - 3 MINGGU',
            4 => 'DALAM SATU BULAN',
            5 => 'DALAM 1 - 3 BULAN',
            6 => 'KONFIRMASI DAHULU'
        ];

        $candidates = Candidate::join('profiles', 'profiles.id', '=', 'candidates.profile_id');
        $cities = $candidates->pluck('profiles.city_id');
        $education = $candidates->join('last_education', 'profiles.id', '=', 'last_education.profile_id')->pluck('last_education.education_id');
        $context = [
            'availablity' => $availablity,
            'cities' => City::whereIn('id', $cities)->get(),
            'education' => Education::whereIn('id', $education)->get()
        ];
        return view('pages.recruitment.form.filter', $context);
    }
}
