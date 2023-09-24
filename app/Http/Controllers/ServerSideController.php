<?php

namespace App\Http\Controllers;

use App\Models\TableCode;
use App\Models\Candidate;
use App\Models\Partner;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use DataTables;

use RealRashid\SweetAlert\Facades\Alert;

class ServerSideController extends Controller
{
    public function __construct(Request $request)
    {
        //
    }

    public function __invoke(Request $request)
    {
        //
    }

    // route('any');
    /* ========================================================================================== */
    public function selectProvider(Request $request, string $table) {
        $tuples = DB::table($table)->select('id', 'created_at')->orderBy('id')->groupBy('id')->get();
        if (Schema::hasColumn($table, 'name')) {
            $tuples = DB::table($table)->select('id', 'name')->orderBy('name')->groupBy('name')->get();
        }

        if ($request->ajax()) {
            if ($request->has('keyword')) {
                $ordering = ($request->has('ordering')) ? $request->ordering : 'asc';
                $tuples = DB::table($table)->select('id', 'created_at')->where('id', 'like', "%{$request->keyword}%")->orderBy('id', $ordering)->groupBy('id')->get();
                if (Schema::hasColumn($table, 'name')) {
                    $tuples = DB::table($table)->select('id', 'name')->where('name', 'like', "%{$request->keyword}%")->orderBy('name', $ordering)->groupBy('name')->get();
                }
            }
        }
    	return response()->json($tuples);
    }

    public function getForeignValue(Request $request, string $id) {
        $response = DB::table($request->table)->where('id', $id)->get();
        return response()->json($response);
    }

    public function showImageOnModal(string $filename) {
        $data = ['code' => 300, 'url' => asset('img/unknown.webp')];
        if (file_exists(public_path('img/' . $filename))) {
            $data = ['code' => 200, 'url' => asset('img/' . $filename)];
        }
        return response()->json($data);
    }

    // route('recruitment.index');
    /* ========================================================================================== */
    public function fetchCandidate(Request $request) {
        $data = Candidate::join('profiles', 'candidates.profile_id', '=', 'profiles.id')->with(['profile' => function($query) {
            $query->with(['city', 'gender'])->with(['last_education' => function($query) {
                $query->with('education');
            }]);
        }]);

        if (!empty($request->age)) {
            $data = $data->hasAge($request->age);
        }

        if (!empty($request->city)) {
            $data = $data->hasCities($request->city);
        }

        if (!empty($request->gender)) {
            $data = $data->hasGenders($request->gender);
        }

        if (!empty($request->education)) {
            $data = $data->hasEducation($request->education);
        }

        if (!empty($request->min_limit) || !empty($request->max_limit)) {
            $min = $request->min_limit;
            $max = $request->max_limit;

            if (empty($request->min_limit)) { $min = Candidate::min('expected_salary'); }
            if (empty($request->max_limit)) { $max = Candidate::max('expected_salary'); }

            $limit = ['min' => $min, 'max' => $max];
            $data = $data->hasExpectedSalary($limit);
        }

        if (!empty($request->ready_to_work)) {
            $data = $data->hasAvailability($request->ready_to_work);
        }

        $data = $data->with('appliedTo')->withCount('appliedTo')->get();
        return DataTables::of($data)->make(true);
    }

    // route('vacancy.index');
    /* ========================================================================================== */
    public function fetchVacancy(Request $request) {
        $data = Vacancy::withCount('candidates')->with(['type', 'skills', 'region', 'position', 'education', 'candidates', 'city', 'categories', 'project' => function($query) {
            return $query->with(['partner']);
        }, 'creator', 'editor', 'terminator'])->latest()->get();
        return DataTables::of($data)->make(true);
    }

    // route('vacancy.show');
    /* ========================================================================================== */
    public function fetchAppliedCandidates(Request $request, string $id) {
        $data = Candidate::join('profiles', 'candidates.profile_id', '=', 'profiles.id')->with(['profile' => function($query) {
            $query->with(['city', 'gender'])->with(['last_education' => function($query) {
                $query->with('education');
            }]);
        }])->whereHas('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', $id);
        })->with('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', $id);
        })->with('interviewSchedules', function($query) use($id) {
            $query->with('proposal');
        })->withCount('appliedTo');

        if (!empty($request->table) && $request->table == 'applied') {
            if (!empty($request->age)) {
                $data = $data->hasAge($request->age);
            }

            if (!empty($request->city)) {
                $data = $data->hasCities($request->city);
            }

            if (!empty($request->gender)) {
                $data = $data->hasGenders($request->gender);
            }

            if (!empty($request->education)) {
                $data = $data->hasEducation($request->education);
            }

            if (!empty($request->min_limit) || !empty($request->max_limit)) {
                $min = $request->min_limit;
                $max = $request->max_limit;

                if (empty($request->min_limit)) { $min = Candidate::min('expected_salary'); }
                if (empty($request->max_limit)) { $max = Candidate::max('expected_salary'); }

                $limit = ['min' => $min, 'max' => $max];
                $data = $data->hasExpectedSalary($limit);
            }

            if (!empty($request->ready_to_work)) {
                $data = $data->hasAvailability($request->ready_to_work);
            }
        }

        $data = $data->get();

        return DataTables::of($data)->make(true);
    }

    public function fetchOtherCandidates(Request $request, string $id) {
        $data = Candidate::join('profiles', 'candidates.profile_id', '=', 'profiles.id')->with(['profile' => function($query) {
            $query->with(['city', 'gender'])->with(['last_education' => function($query) {
                $query->with('education');
            }]);
        }])->whereDoesntHave('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', $id);
        })->with('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', $id);
        })->withCount('appliedTo');

        if (!empty($request->table) && $request->table == 'applied') {
            if (!empty($request->age)) {
                $data = $data->hasAge($request->age);
            }

            if (!empty($request->city)) {
                $data = $data->hasCities($request->city);
            }

            if (!empty($request->gender)) {
                $data = $data->hasGenders($request->gender);
            }

            if (!empty($request->education)) {
                $data = $data->hasEducation($request->education);
            }

            if (!empty($request->min_limit) || !empty($request->max_limit)) {
                $min = $request->min_limit;
                $max = $request->max_limit;

                if (empty($request->min_limit)) { $min = Candidate::min('expected_salary'); }
                if (empty($request->max_limit)) { $max = Candidate::max('expected_salary'); }

                $limit = ['min' => $min, 'max' => $max];
                $data = $data->hasExpectedSalary($limit);
            }

            if (!empty($request->ready_to_work)) {
                $data = $data->hasAvailability($request->ready_to_work);
            }
        }

        $data = $data->get();

        return DataTables::of($data)->make(true);
    }

    // route('server.chartPartner');
    /* ========================================================================================== */
    public function chartPartner() {
        $partnerCount = Partner::yearlyCount();
        return response()->json($partnerCount);
    }

    // route('server.chartCandidate');
    /* ========================================================================================== */
    public function chartCandidate() {
        $candidatesCount = Candidate::yearlyCount();
        return response()->json($candidatesCount);
    }

    // route('server.chartVacancy')
    /* ========================================================================================== */
    public function chartVacancy() {
        $vacancyCount = Vacancy::yearlyCount();
        return response()->json($vacancyCount);
    }

    // route('server.test')
    /* ========================================================================================== */
    public function fetchingTest(Request $request, string $id) {
        // FOR-AJAX-TESTING-PURPOSES-ONLY
    }
}