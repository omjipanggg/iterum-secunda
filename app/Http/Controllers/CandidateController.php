<?php

namespace App\Http\Controllers;

use App\Models\Candidate;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'candidate.only', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [];
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
        //
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
        dd($request->all());
    }

}
