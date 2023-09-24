<?php

namespace App\Http\Controllers;

use App\Models\TestQuestion;
use Illuminate\Http\Request;

class SelfTestController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    public function index()
    {
        $context = [];
        return view('pages.vacancy.question.index', $context);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TestQuestion $testQuestion)
    {
        //
    }

    public function edit(TestQuestion $testQuestion)
    {
        //
    }

    public function update(Request $request, TestQuestion $testQuestion)
    {
        //
    }

    public function destroy(TestQuestion $testQuestion)
    {
        //
    }
}
