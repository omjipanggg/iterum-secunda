<?php

namespace App\Http\Controllers;

use App\Models\TableCode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function selectProvider(Request $request, $table) {
    	$tuples = [];

        if ($request->ajax()) {
            if ($request->has('keyword')) {
                $tuples = DB::table($table)->select('id', 'name')->where('name', 'like', "%{$request->keyword}%")->orderBy('name')->get();
            }
        }

    	return response()->json($tuples);
    }
}