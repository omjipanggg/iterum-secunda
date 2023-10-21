<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\InterviewSchedule as Schedule;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use RealRashid\SweetAlert\Facades\Alert;

class PortalController extends Controller
{
    public function __construct() {
        Vacancy::where('closing_date', '<', Carbon::today())->update(['active' => false]);
    }

    public function index(Request $request)
    {
        $vacancies = Vacancy::where([
            ['closing_date', '>=', today()],
            ['active', true]
        ])
        ->withCount('candidates')
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->orderByDesc('closing_date')
        ->paginate(6);

        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $vacancies = Vacancy::filter($keyword)
            ->where([
                ['closing_date', '>=', today()],
                ['active', true]
            ])
            ->withCount('candidates')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->orderByDesc('closing_date')
            ->paginate(6);
        }

        $context = [
            'vacancies' => $vacancies
        ];
        return view('pages.portal.index', $context);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $slug)
    {
        $data = [];
        $vacancy = Vacancy::where('slug', $slug)->withCount('candidates')->first();

        if (!$vacancy) {
            alert()->error('Kesalahan', 'Lowongan Kerja tidak ditemukan.');
            return redirect()->route('home.index');
        }

        /*
        if (auth()->check()) {
            if (!auth()->user()->hasRole([1, 5])) {
                alert()->error('Kesalahan', 'Lowongan Kerja sudah kedaluwarsa.');
                return redirect()->route('home.index');
            }
        } else {
            if ($vacancy->closing_date < Carbon::today()) {
                alert()->error('Kesalahan', 'Lowongan Kerja sudah kedaluwarsa.');
                return redirect()->route('home.index');
            }
        }
        */

        $vacancy_id = $vacancy->id;

        $categories = $vacancy->categories()->pluck('vacancy_categories.id');

        $related = Vacancy::whereHas('categories', function($query) use($categories) {
            $query->whereIn('vacancy_category_id', $categories);
        })->where([
            ['slug', '<>', $slug],
            ['closing_date', '>=', Carbon::today()],
            ['active', true]
        ])
        ->withCount('candidates')
        ->inRandomOrder()
        ->take(4)
        ->get();

        $status = false;
        if (auth()->check()) {
            if (auth()->user()->hasRole(7)) {
                $candidate_id = auth()->user()->profile->candidate->id;
                $status = Candidate::whereHas('appliedTo', function($query) use($candidate_id, $vacancy_id) {
                    $query->where('candidate_id', $candidate_id)->where('vacancy_id', $vacancy_id);
                })->exists();

                $data = Candidate::whereHas('appliedTo', function($query) use($candidate_id, $vacancy_id) {
                    $query->where('candidate_id', $candidate_id)->where('vacancy_id', $vacancy_id);
                })->with('interviewSchedules', function($query) {
                    $query->with('proposal');
                })->first();
            }
        }

        $context = [
            'data' => $data,
            'status' => $status,
            'vacancy' => $vacancy,
            'related' => $related
        ];

        return view('pages.portal.show', $context);
    }

    public function filter(Request $request) {
        $vacancies = [];
        if (!empty($request->keyword)) {
            $vacancies = Vacancy::filter($request->keyword)
                ->where([
                    ['closing_date', '>=', today()],
                    ['active', true]
                ])
                ->withCount('candidates')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->orderByDesc('closing_date')
                ->paginate(6);
        }
        return response()->json($vacancies);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
