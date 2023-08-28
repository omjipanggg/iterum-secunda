<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;

use Illuminate\Http\Request;

class PortalController extends Controller
{
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

    public function home() {
        return 'HOME';
    }

    public function question() {
        return 'Question';
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
        $vacancy = Vacancy::where('slug', $slug)->withCount('candidates')->first();
        $categories = $vacancy->categories()->pluck('vacancy_categories.id');
        $related = Vacancy::whereHas('categories', function($query) use($categories) {
            $query->whereIn('vacancy_category_id', $categories);
        })->where([
            ['slug', '<>', $slug],
            ['closing_date', '>=', today()],
            ['active', true]
        ])->with('categories')
        ->withCount('candidates')
        ->inRandomOrder()
        ->take(4)
        ->get();

        $context = [
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
