<?php

namespace App\Http\Controllers;

use App\Models\TableCode;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DataTables;

use RealRashid\SweetAlert\Facades\Alert;

class ServerSideController extends Controller
{
    public function __construct(Request $request)
    {
        //
    }

    public function __invoke(Request $request)
    {
        //
    }

    // route('any');
    public function selectProvider(Request $request, string $table) {
        $tuples = DB::table($table)->select('id', 'name')->orderBy('name')->groupBy('name')->get();
        if ($request->ajax()) {
            if ($request->has('keyword')) {
                $tuples = DB::table($table)->select('id', 'name')->where('name', 'like', "%{$request->keyword}%")->orderBy('name')->groupBy('name')->get();
            }
        }
    	return response()->json($tuples);
    }

    // route('vacancy.index');
    public function fetchVacancy(Request $request) {
        $data = Vacancy::withCount('candidates')->with(['type', 'skills', 'position', 'education', 'candidates', 'city', 'categories', 'project' => function($query) {
            return $query->with(['partner']);
        }, 'creator', 'editor', 'terminator'])->latest()->get();
        return DataTables::of($data)->make(true);
    }
}