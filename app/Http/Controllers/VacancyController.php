<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;

use Illuminate\Http\Request;
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::find($id);
        $similar = Vacancy::whereHas('project', function($query) use($vacancy) {
            $query->where('project_number', $vacancy->project->project_number);
        })->where('id', '<>', $id)->with(['project'])->get();

        $context = [
            'vacancy' => $vacancy,
            'similar' => $similar
        ];
        return view('pages.vacancy.show', $context);
    }

    public function edit(string $id)
    {
        $vacancy = Vacancy::find($id);
        $context = [
            'vacancy' => $vacancy
        ];
        return view('pages.vacancy.edit', $context);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function question() {
        return 'Question';
    }

    public function publish(string $id) {
        $vacancy = Vacancy::find($id);
        alert()->success(Str::upper($vacancy->name), 'Lowongan Kerja berhasil diterbitkan.');
        return redirect()->route('vacancy.index');
    }

    public function archive(string $id) {
        $vacancy = Vacancy::find($id);
        alert()->success(Str::upper($vacancy->name), 'Lowongan Kerja berhasil diarsipkan.');
        return redirect()->route('vacancy.index');
    }
}
