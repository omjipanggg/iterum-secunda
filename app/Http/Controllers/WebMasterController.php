<?php

namespace App\Http\Controllers;

use App\Models\TableCode;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class WebMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'restricted']);
    }

    protected function generateTables() {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        $result = [];

        TableCode::truncate();
        foreach ($tables as $key => $value) {
            $result[$key]['name'] = $value;
            $result[$key]['code'] = Str::uuid();
            $result[$key]['label'] = Str::headline(Str::singular($value));
            $result[$key]['slug'] = Str::slug(Str::singular($value));
            TableCode::create($result[$key]);
        }
    }

    public function index()
    {
        // $this->generateTables();

        $context = [
            'tables' => TableCode::all()
        ];
        return view('pages.master.index', $context);
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
        dd($id);
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
