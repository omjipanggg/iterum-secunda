<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::withTrashed()->get();
        $context = [
            'candidates' => $candidates
        ];
        return view('pages.candidate.index', $context);
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
    public function show(Candidate $candidate)
    {
        $context = [
            'candidate' => $candidate
        ];
        return view('pages.candidate.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }

    public function apply(Request $request)
    {
        $vacancy_id = $request->vacancy_id;
        $vacancy = Vacancy::find($request->vacancy_id);
        $candidate = Candidate::find($request->candidate_id);

        $candidateColumns = array_keys($candidate->toArray());
        $excludedCandidateColumns = ['expected_facility', 'expected_salary', 'ready_to_work', 'motivation', 'status', 'created_at', 'updated_at', 'deleted_at'];
        $candidateDiff = array_diff($candidateColumns, $excludedCandidateColumns);

        $incomplete = false;
        foreach ($candidateDiff as $column) {
            if (empty($candidate->$column)) {
                $incomplete = true;
            }
        }

        $profileColumns = array_keys($candidate->profile->toArray());
        $excludedProfileColumns = ['family_number', 'healthcare_number', 'tax_number', 'national_address', 'marital_status_id', 'blood_type_id', 'secondary_email', 'created_at', 'updated_at', 'deleted_at'];
        $profileDiff = array_diff($profileColumns, $excludedProfileColumns);

        foreach ($profileDiff as $column) {
            if (empty($candidate->profile->$column)) {
                $incomplete = true;
            }
        }

        if ($incomplete) {
            alert()->warning('Perhatian', 'Mohon lengkapi data diri Anda terlebih dahulu.');
            return redirect()->route('profile.index');
        }

        $appliedTo = $candidate->whereHas('appliedTo', function($query) use($vacancy_id) {
            $query->where('vacancy_id', $vacancy_id);
        })->exists();

        if ($appliedTo) {
            alert()->error('Kesalahan', 'Anda sudah melamar di sini.');
        } else {
            $candidate->appliedTo()->attach($vacancy_id, [
                'resume' => $request->resume,
                'description' => $request->cover_letter,
                'status' => 1
            ]);
            alert()->success(Str::upper($vacancy->name), 'Lamaran Anda terkirim!');
        }

        return redirect()->back()->with('code', 200);
    }

    public function editResume($id) {
        $context = ['candidate_id' => $id];
        return view('pages.candidate.form.edit-resume', $context);
    }

    public function updateResume(Request $request, $id) {
        $candidate = Candidate::find($id);

        if ($request->hasFile('resume')) {
            $filename = 'CV_' . Str::replace(' ', '', $candidate->profile->name) . '_' . $id . '_' . Str::substr(strtotime('now'), -6) . '.' . $request->file('resume')->extension();
            $result =  $request->file('resume')->storeAs('profiles/resumes', $filename, 'public');
        }

        $path = storage_path('app/public/profiles/resumes/' . $candidate->resume);
        if (file_exists($path)) {
            unlink($path);
        }

        $candidate->resume = $filename;
        $candidate->save();

        alert()->success('Sukses', 'CV Anda berhasil diperbarui.');
        return redirect()->back()->with('code', 200);
    }
}
