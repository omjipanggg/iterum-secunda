<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\VacancyCategory as Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [
            'categories' => Category::withCount('vacancies')->get()
        ];
        return view('pages.portal.category.index', $context);
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
        $category = Category::where('slug', $slug)->with('vacancies')->withCount('vacancies')->first();
        $vacancies = Vacancy::whereHas('categories', function($query) use($slug) {
            $query->where('slug', $slug);
        })->paginate(3);
        $context = [
            'data' => $category,
            'vacancies' => $vacancies
        ];
        return view('pages.portal.category.show', $context);
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
