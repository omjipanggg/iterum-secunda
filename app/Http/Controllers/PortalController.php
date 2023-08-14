<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function show(string $slug)
    {
        $vacancy = Vacancy::where('slug', $slug)->withCount('candidates')->first();
        $context = [
            'vacancy' => $vacancy
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
