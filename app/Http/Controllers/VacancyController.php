<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Education;
use App\Models\JobTitle;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Region;
use App\Models\Skill;
use App\Models\Vacancy;
use App\Models\VacancyCategory as Category;
use App\Models\VacancyTest as Test;
use App\Models\VacancyType as Type;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class VacancyController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    public function index()
    {
        $context = [];
        return view('pages.vacancy.index', $context);
    }

    /* CATEGORY
    /* ======================================================================== */
    public function createCategory() {
        return view('pages.vacancy.form.category.create');
    }

    public function storeCategory(Request $request) {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return response()->json($category);
    }

    /* PARTNER
    /* ======================================================================== */
    public function createPartner() {
        $context = [
            'regions' => Region::orderBy('code')->get()
        ];
        return view('pages.vacancy.form.partner.create', $context);
    }

    public function storePartner(Request $request) {
        $partner = Partner::create($request->except(['picture']));

        if ($request->hasFile('picture')) {
            $filename = Str::upper(Str::snake($request->name)) . '_' . Str::substr(strtotime('now'), -6) . '.' . $request->file('picture')->extension();
            $result =  $request->file('picture')->storeAs('partners/images', $filename, 'public');
            $partner->picture = $filename;
        }

        $partner->slug = Str::slug($request->name) . '-' . Str::substr(strtotime('now'), -6);
        $partner->prefix = set_prefix($request->name);
        $partner->active = true;
        $partner->status = 1;
        $partner->save();

        $response = [
            'data' => $partner,
            'code' => 200
        ];

        if (!$partner) {
            $response = ['code' => 307];
        }

        return response()->json($response);
    }

    /* PROJECT
    /* ======================================================================== */
    public function createProject() {
        return view('pages.vacancy.form.project.create');
    }

    public function storeProject(Request $request) {
        $project = Project::create($request->all());
        $project->slug = Str::slug($request->name) . '-' . Str::substr(strtotime('now'), -6);
        $project->status = 1;
        $project->active = 1;
        $project->save();

        $response = [
            'data' => $project,
            'code' => 200
        ];

        if (!$project) {
            $response = ['code' => 307];
        }

        return response()->json($response);
    }

    /* CREATE-A-NEW-VACANCY
    /* ======================================================================== */
    public function create()
    {
        $context = [
            'categories' => Category::all(),
            'education' => Education::whereNotIn('id', [1, 2, 3, 4])->orderByDesc('id')->get(),
            'projects' => Project::where('id', '<>', '00000000-0000-0000-0000-000000000000')->get(),
            'regions' => Region::orderBy('code')->get()
        ];
        return view('pages.vacancy.create', $context);
    }

    public function store(Request $request)
    {
        $stored = Vacancy::create($request->except(['test_category', 'test_limitation', 'test_duration', 'test_name', 'unique_number', 'education', 'categories', 'skills', 'partner_id', 'project_id']));

        $job = JobTitle::where('name', 'LIKE', '%' . $request->name . '%')->first();
        if ($job) {
            $job_id = $job->id;
        } else {
            $new_job = JobTitle::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            $job_id = $new_job->id;
        }
        $stored->job_title_id = $job_id;

        if ($request->has('skills')) {
            foreach ($request->skills as $skill) {
                $skill_id = $skill;
                if (!is_numeric($skill)) {
                    $new_skill = Skill::create(['name' => Str::slug($skill)]);
                    $skill_id = $new_skill->id;
                }
                $stored->skills()->attach($skill_id);
            }
        }

        $partner_id = '00000000-0000-0000-0000-000000000000';
        if ($request->has('partner_id')) {
            $partner_id = $request->partner_id;
            if (!is_uuid($request->partner_id)) {
                $new_partner = Partner::create([
                    'name' => $request->partner_id,
                    'prefix' => get_initial($request->partner_id),
                    'city_id' => 155,
                    'person_in_charge' => '-',
                    'phone_number' => '-',
                    'active' => 1,
                    'status' => 1,
                    'slug' => Str::slug($request->partner_id)
                ]);
                $partner_id = $new_partner->id;
            }
        }

        $project_id = '00000000-0000-0000-0000-000000000000';
        $project_name = 'Project Baru - ' . $request->name;
        if ($request->has('project_id')) {
            $project_id = $request->project_id;
            if (!is_uuid($request->project_id)) {
                $new_project = Project::create([
                    'project_number' => $request->project_id,
                    'name' => $project_name,
                    'starting_date' => Carbon::now(),
                    'ending_date' => Carbon::now()->addMonths(6),
                    'partner_id' => $partner_id,
                    'person_in_charge' => '-',
                    'phone_number' => '-',
                    'active' => 1,
                    'status' => 0,
                    'description' => 'Mohon sesuaikan sebelum PKWT diterbitkan.',
                    'slug' => Str::slug($project_name)
                ]);
                $project_id = $new_project->id;
            }
        } else {
            $new_project = Project::create([
                'project_number' => '000-BELUM-DISESUAIKAN',
                'name' => $project_name,
                'starting_date' => Carbon::now(),
                'ending_date' => Carbon::now()->addMonths(6),
                'partner_id' => $partner_id,
                'person_in_charge' => '-',
                'phone_number' => '-',
                'active' => 1,
                'status' => 0,
                'description' => 'Mohon sesuaikan sebelum PKWT diterbitkan.',
                'slug' => Str::slug($project_name)
            ]);
            $project_id = $new_project->id;
        }
        $stored->project_id = $project_id;

        if ($request->has('education')) {
            $stored->education()->detach();
            foreach ($request->education as $education) {
                $stored->education()->attach($education);
            }
        }

        if ($request->has('categories')) {
            $stored->categories()->detach();
            foreach ($request->categories as $category) {
                $stored->categories()->attach($category);
            }
        }

        if ($request->has('test_category')) {
            foreach ($request->test_category as $key => $value) {
                $exam = Test::create([
                    'vacancy_id' => $stored->id,
                    'name' => $request->test_name[$key],
                    'limitation' => $request->test_limitation[$key],
                    'duration' => $request->test_duration[$key],
                    'category_id' => $value,
                    'unique_number' => $request->unique_number
                ]);
            }
        }

        $stored->slug = Str::slug($request->name) . '-' . Str::substr(strtotime('now'), -6);
        $stored->published_at = Carbon::now();

        if (!$stored->save()) {
            alert()->error('Kesalahan', 'Tidak dapat menyimpan Lowongan Kerja.');
            return redirect()->back()->with('code', 500);
        }

        \Log::create('Stored—vacancies ('. Str::upper($id) .')');
        // $stored->regions->sync($request->region_id);

        alert()->success('Sukses', 'Lowongan Kerja berhasil dibuat.')->autoClose(false);
        return redirect()->route('vacancy.index')->with('code', 200);
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            alert()->error('Kesalahan', 'Lowongan Kerja tidak ditemukan.');
            return redirect()->route('vacancy.index');
        }

        $similar = Vacancy::whereHas('project', function($query) use($vacancy) {
            $query->where('project_number', $vacancy->project->project_number);
        })->where('id', '<>', $id)->orderByDesc('active')->orderBy('name')->get();

        // $candidates = Candidate::join('profiles', 'candidates.profile_id', '=', 'profiles.id')->orderBy('profiles.name')->get();

        $context = [
            // 'candidates' => $candidates,
            'vacancy' => $vacancy,
            'similar' => $similar
        ];
        return view('pages.vacancy.show', $context);
    }

    public function edit(string $id)
    {
        $context = [
            'types' => Type::all(),
            'skills' => Skill::all(),
            'regions' => Region::whereNotIn('code', ['01', '11'])->orderBy('code')->get(),
            'projects' => Project::where('id', '<>', '00000000-0000-0000-0000-000000000000')->get(),
            'categories' => Category::all(),
            'education' => Education::whereNotIn('id', [1, 2, 3, 4])->orderByDesc('id')->get(),
            'partners' => Partner::all(),
            'vacancy' => Vacancy::findOrFail($id)
        ];

        return view('pages.vacancy.edit', $context);
    }

    public function update(Request $request, string $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update(
            $request->except([
                'test_category', 'test_limitation', 'test_duration',
                'test_name', 'unique_number', 'education', 'categories',
                'skills', 'partner_id', 'project_id', 'name'
            ])
        );

        $job = JobTitle::where('name', 'LIKE', '%' . $request->name . '%')->first();
        if ($job) {
            $job_id = $job->id;
        } else {
            $new_job = JobTitle::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            $job_id = $new_job->id;
        }
        $vacancy->job_title_id = $job_id;

        if ($request->has('skills')) {
            $vacancy->skills()->detach();
            foreach ($request->skills as $skill) {
                $skill_id = $skill;
                if (!is_numeric($skill)) {
                    $new_skill = Skill::create(['name' => Str::slug($skill)]);
                    $skill_id = $new_skill->id;
                }
                $vacancy->skills()->attach($skill_id);
            }
        }

        $partner_id = '00000000-0000-0000-0000-000000000000';
        if ($request->has('partner_id')) {
            $partner_id = $request->partner_id;
            if (!is_uuid($request->partner_id)) {
                $new_partner = Partner::create([
                    'name' => $request->partner_id,
                    'prefix' => get_initial($request->partner_id),
                    'city_id' => 155,
                    'person_in_charge' => '-',
                    'phone_number' => '-',
                    'active' => 1,
                    'status' => 1,
                    'slug' => Str::slug($request->partner_id)
                ]);
                $partner_id = $new_partner->id;
            }
        }

        $project_id = '00000000-0000-0000-0000-000000000000';
        $project_name = 'Project Baru - ' . $request->name;
        if ($request->has('project_id')) {
            $project_id = $request->project_id;
            if (!is_uuid($request->project_id)) {
                $new_project = Project::create([
                    'project_number' => $request->project_id,
                    'name' => $project_name,
                    'starting_date' => Carbon::now(),
                    'ending_date' => Carbon::now()->addMonths(6),
                    'partner_id' => $partner_id,
                    'person_in_charge' => '-',
                    'phone_number' => '-',
                    'active' => 1,
                    'status' => 0,
                    'description' => 'Mohon sesuaikan sebelum PKWT diterbitkan.',
                    'slug' => Str::slug($project_name)
                ]);
                $project_id = $new_project->id;
            }
        } else {
            $new_project = Project::create([
                'project_number' => '000-BELUM-DISESUAIKAN',
                'name' => $project_name,
                'starting_date' => Carbon::now(),
                'ending_date' => Carbon::now()->addMonths(6),
                'partner_id' => $partner_id,
                'person_in_charge' => '-',
                'phone_number' => '-',
                'active' => 1,
                'status' => 0,
                'description' => 'Mohon sesuaikan sebelum PKWT diterbitkan.',
                'slug' => Str::slug($project_name)
            ]);
            $project_id = $new_project->id;
        }
        $vacancy->project_id = $project_id;

        if ($request->has('education')) {
            $vacancy->education()->detach();
            foreach ($request->education as $education) {
                $vacancy->education()->attach($education);
            }
        }

        if ($request->has('categories')) {
            $vacancy->categories()->detach();
            foreach ($request->categories as $category) {
                $vacancy->categories()->attach($category);
            }
        }

        if ($vacancy->name != $request->name) {
            $vacancy->name = $request->name;
            $vacancy->slug = Str::slug($request->name) . '-' . Str::substr(strtotime('now'), -6);
        }

        $vacancy->published_at = Carbon::now();

        if (!$request->has('hidden_partner')) { $vacancy->hidden_partner = false; }
        if (!$request->has('hidden_placement')) { $vacancy->hidden_placement = false; }
        if (!$request->has('hidden_salary')) { $vacancy->hidden_salary = false; }

        if (!$vacancy->save()) {
            alert()->error('Kesalahan', 'Tidak dapat menyimpan Lowongan Kerja.');
            return redirect()->back()->with('code', 500);
        }

        \Log::create('Updated—vacancies ('. Str::upper($id) .')');
        // $vacancy->regions->sync($request->region_id);

        alert()->success('Sukses', 'Lowongan Kerja berhasil disunting.')->autoClose(false);
        return redirect()->route('vacancy.index')->with('code', 200);
    }

    public function destroy(string $id)
    {
        $vacancy = Vacancy::findorFail($id)->delete();

        \Log::create('Deleted—vacancies ('. Str::upper($id) .')');
        if ($request->ajax()) {
            if (!$query) {
                Alert::error('Kesalahan', 'Coba lagi nanti.');
                return redirect()->back();
            }
            return response()->json(['code' => 200]);
        }

        Alert::success('Sukses', 'Lowongan Kerja berhasil dihapus.');
        return redirect()->back();
    }

    public function question() {
        return view('pages.vacancy.question');
    }

    public function formSelect($id) {
        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            alert()->error('Kesalahan', 'Lowongan Kerja tidak ditemukan.');
            return redirect()->route('vacancy.index');
        }

        $applied = Candidate::whereHas('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', $id);
        })->get();

        $candidates = Candidate::join('profiles', 'candidates.profile_id', '=', 'profiles.id')->whereHas('appliedTo', function($query) use($id) {
            $query->where('vacancy_id', '<>', $id);
        })->orWhereDoesntHave('appliedTo')->orderBy('profiles.name')->get();

        $context = [
            'applied' => $applied,
            'candidates' => $candidates,
            'vacancy' => $vacancy
        ];
        return view('pages.vacancy.form.select', $context);
    }

    public function select(Request $request, $id) {
        dd($request->all());
    }

    public function publish(string $id) {
        $vacancy = Vacancy::findorFail($id);
        $vacancy->published_at = Carbon::now();
        $vacancy->active = true;
        $vacancy->save();
        alert()->success(Str::upper($vacancy->name), 'Lowongan Kerja berhasil diterbitkan.')->autoClose(false);
        return redirect()->route('vacancy.index');
    }

    public function archive(string $id) {
        $vacancy = Vacancy::findorFail($id);
        $vacancy->active = false;
        $vacancy->save();
        alert()->success(Str::upper($vacancy->name), 'Lowongan Kerja berhasil diarsipkan.')->autoClose(false);
        return redirect()->route('vacancy.index');
    }
}
