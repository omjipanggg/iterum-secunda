<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Partner;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // CANDIDATE
        $candidates = Candidate::all();
        $candidate_genders = Candidate::join('profiles', 'profiles.id', '=', 'candidates.profile_id')->select('*')->selectRaw('count(*) as total')->groupBy('profiles.gender_id')->get();

        // PARTNER
        $partners = Partner::all();
        $partner_regions = Partner::join('regions', 'regions.id', '=' , 'partners.region_id')->select('*')->selectRaw('count(*) as total')->groupBy('region_id')->orderBy('regions.code')->get();

        // VACANCY
        $vacancies = Vacancy::all();
        $vacancy_regions = Vacancy::join('regions', 'regions.id', '=' , 'vacancies.region_id')->select('*')->selectRaw('count(*) as total')->groupBy('region_id')->orderBy('regions.code')->get();
        $vacancy_status = Vacancy::select('*')->selectRaw('count(*) as total')->groupBy('active')->orderByDesc('active')->get();

        $context = [
            'partners' => $partners,
            'partner_regions' => $partner_regions,
            'candidates' => $candidates,
            'candidate_genders' => $candidate_genders,
            'vacancies' => $vacancies,
            'vacancy_regions' => $vacancy_regions,
            'vacancy_status' => $vacancy_status
        ];

        return view('pages.dashboard.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
