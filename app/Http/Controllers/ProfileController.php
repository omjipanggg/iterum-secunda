<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Candidate;
use App\Models\City;
use App\Models\EducationField;
use App\Models\Experience;
use App\Models\Gender;
use App\Models\HigherEducation;
use App\Models\LastEducation;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\Relative;
use App\Models\Skill;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $availabilities = Availability::all();
        $genders = Gender::all();
        $cities = City::orderBy('name')->groupBy('name')->get();
        $maritals = MaritalStatus::all();
        $context = [
            'avails' => $availabilities,
            'cities' => $cities,
            'genders' => $genders,
            'maritals' => $maritals
        ];

        return view('pages.profile.index', $context);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        alert()->success('Sukses', 'Data Diri berhasil ditambahkan.');
        return redirect()->back()->with('code', 200);
    }

    public function show(string $id)
    {
        dd($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        alert()->success('Sukses', 'Data Diri berhasil diperbarui.');
        return redirect()->back()->with('code', 200);
    }

    public function destroy(string $id)
    {
        //
    }

    public function detail(string $id) {
        $profile = Profile::find($id);

        if (!$profile) {
            alert()->error('Kesalahan', 'Data tidak ditemukan.');
            return redirect()->back()->with('code', 320);
        }

        $context = [
            'profile' => $profile
        ];

        return view('pages.profile.form.detail', $context);
    }

    public function destroyData(string $id, string $parameter) {
        return redirect()->back()->with('code', 200);
    }

    public function updatePersonalData(Request $request, string $id) {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'current_address' => 'required',
            'resume' => 'required|max:8192'
        ], [
            'name.required' => 'kolom ini wajib diisi',
            'phone_number.required' => 'kolom ini wajib diisi',
            'current_address.required' => 'kolom ini wajib diisi',
            'resume.required' => 'kolom ini wajib diisi',
            'resume.max' => 'ukuran berkas melebihi batas maksimal'
        ]);

        $profile = Profile::find($id);

        // CANDIDATE-UNIQUE-FIELDS
        if ($request->has('motivation')) {
            $filename = $request->resume ?? 'unknown.pdf';
            if ($request->hasFile('resume')) {
                $filename = 'CV_' . Str::replace(' ', '', $request->name) . '_' . $id . '.' . $request->file('resume')->extension();
                $result =  $request->file('resume')->storeAs('profiles/resumes', $filename, 'public');
            }
            $profile->update($request->except(['expected_salary', 'expected_facility', 'motivation', 'ready_to_work', 'resume']));
            $profile->save();

            Candidate::updateOrCreate([
                'profile_id' => $id
            ], [
                'ready_to_work' => $request->ready_to_work,
                'expected_salary' => Str::replace('.', '', $request->expected_salary),
                'expected_facility' => $request->expected_facility,
                'motivation' => $request->motivation,
                'resume' => $filename
            ]);
        }

        User::find($profile->user->id)->update(['name' => $request->name]);

        alert()->success('Sukses', 'Data Diri berhasil diperbarui.');
        return redirect()->back()->with('tab', 'personal');
    }

    public function editEducationData(string $id) {
        $context = [];
        return view('pages.profile.form.editEducationData', $context);
    }

    public function updateEducationData(Request $request, string $id) {
        $profile = Profile::find($id);

        $last = LastEducation::create([
            'profile_id' => $id,
            'education_id' => $request->education_id,
            'city_id' => $request->city_id,
            'graduation_year' => $request->graduation_year,
            'cgpa' => $request->cgpa
        ]);

        $heid = $request->higher_education_id;
        if (!is_numeric($request->higher_education_id)) {
            $new_heid = HigherEducation::create(['name' => $request->higher_education_id]);
            $heid = $new_heid->id;
        }
        $last->higher_education_id = $heid;

        $efid = $request->education_field_id;
        if (!is_numeric($request->education_field_id)) {
            $new_efid = EducationField::create(['name' => $request->education_field_id]);
            $efid = $new_efid->id;
        }
        $last->education_field_id = $efid;

        if ($request->hasFile('certificate')) {
            $filename = 'IJAZAH_' . Str::upper(Str::snake($profile->name)) . '_' . $heid . '.' . $request->file('certificate')->extension();
            $result = $request->file('certificate')->storeAs('profiles/education/', $filename, 'public');
            $last->certificate = $filename;
        }
        $last->save();

        alert()->success('Sukses', 'Data Pendidikan berhasil diperbarui.');
        return redirect()->back()->with('tab', 'education');
    }

    public function editExperienceData(string $id) {
        $context = [];
        return view('pages.profile.form.editExperienceData', $context);
    }

    public function updateExperienceData(Request $request, string $id) {
        $experience = Experience::create([
            'profile_id' => $id,
            'city_id' => $request->city_id,
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'starting_date' => $request->starting_date,
            'manager_name' => $request->manager_name,
            'manager_contact' => $request->manager_contact
        ]);

        if (!$request->has('until_now')) {
            $experience->ending_date = $request->ending_date;
        }

        $experience->save();

        alert()->success('Sukses', 'Data Pengalaman berhasil diperbarui.');
        return redirect()->back()->with('tab', 'experience');
    }

    public function editSkillData(string $id) {
        $context = [];
        return view('pages.profile.form.editSkillData', $context);
    }

    public function updateSkillData(Request $request, string $id) {
        $profile = Profile::find($id);

        $skill_id = $request->skill_id;
        if (!is_numeric($request->skill_id)) {
            $new_skill = Skill::create(['name' => Str::slug($request->skill_id)]);
            $skill_id = $new_skill->id;
        }

        $filename = null;
        if ($request->hasFile('certificate')) {
            $filename = 'KOMPETENSI_' . $request->rate . '_' . $skill_id . '_' . Str::upper($id) . '.' . $request->file('certificate')->extension();
            $result = $request->file('certificate')->storeAs('profiles/certificates/', $filename, 'public');
        }

        $profile->skills()->attach(
            $skill_id, [
                'certificate' => $filename,
                'rate' => $request->rate
            ]
        );

        alert()->success('Sukses', 'Data Keahlian berhasil diperbarui.');
        return redirect()->back()->with('tab', 'skill');
    }

    public function editFamilyData(string $id) {
        $context = [];
        return view('pages.profile.form.editFamilyData', $context);
    }

    public function updateFamilyData(Request $request, string $id) {
        Relative::create($request->all());
        alert()->success('Sukses', 'Data Keluarga berhasil diperbarui.');
        return redirect()->back()->with('tab', 'family');
    }
}
