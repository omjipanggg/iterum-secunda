<?php

namespace App\Http\Controllers;

use App\Models\Availability;
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

    public function show(string $id) {
        $candidate = Candidate::where('id', $id)->with(['profile', 'appliedTo'])->with('interviewSchedules', function($query) {
            $query->with('proposal');
        })->withCount(['profile', 'appliedTo', 'interviewSchedules'])->first();

        if (!$candidate) {
            alert()->error('Kesalahan', 'Pelamar tidak ditemukan.');
            return redirect()->back()->with('code', 317);
        }

        $context = [
            'candidate' => $candidate
        ];
        return view('pages.recruitment.show', $context);
    }

    public function filter() {
        /* $availability = [1 => 'SEGERA', 2 => 'DALAM SATU MINGGU', 3 => 'DALAM 1 - 3 MINGGU',
        4 => 'DALAM SATU BULAN', 5 => 'DALAM 1 - 3 BULAN', 6 => 'KONFIRMASI DAHULU']; */

        $availability = Availability::all();
        $candidates = Candidate::join('profiles', 'profiles.id', '=', 'candidates.profile_id');
        $cityTuples = $candidates->pluck('profiles.city_id');
        $cities = City::whereIn('id', $cityTuples)->get();
        $educationTuples = $candidates->join('last_education', 'profiles.id', '=', 'last_education.profile_id')->pluck('last_education.education_id');
        $education = Education::whereIn('id', $educationTuples)->get();
        $context = [
            'availability' => $availability,
            'cities' => $cities,
            'education' => $education
        ];

        return view('pages.recruitment.form.filter', $context);
    }

    public function apply(Request $request) {
        $candidate = Candidate::find($request->candidate);
        $candidate->appliedTo()->attach($request->vacancy, [
            'resume' => $candidate->resume,
            'description' => '<p>Dipilih oleh ' . auth()->user()->name . '.</p>'
        ]);

        alert()->success(Str::upper($candidate->name), 'Pelamar berhasil dipilih.');
        return redirect()->back()->with('code', 200);
    }
}
