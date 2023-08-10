<?php

namespace App\Http\Controllers;

use App\Forms\Insert;

use App\Models\TableCode;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use DataTables;

use Kris\LaravelFormBuilder\FormBuilder;
use RealRashid\SweetAlert\Facades\Alert;

class WebMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'restricted']);
        // generate_table_code();
    }

    public function index(FormBuilder $builder)
    {
        $context = [
            'tables' => TableCode::all()
        ];
        return view('pages.master.index', $context);
    }

    public function create(string $table, FormBuilder $builder)
    {
        $form = $builder->create(Insert::class, [
            'method' => 'POST',
            'url' => route('master.store', $table),
            'model' => $table,
        ]);

        $context = ['form' => $form];

        return view('pages.master.create', compact('form'));
    }

    public function store(Request $request, string $table)
    {
        \Log::create('Updated—'. $table .' ('. Str::uppert($id) .')');
    }

    public function fetch(string $code)
    {
        $table = TableCode::where('code', $code)->first();

        if (!$table) {
            Alert::error('Kesalahan', 'Model tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $model = '\\App\\Models\\' . \Str::studly(\Str::singular($table->name));
        $columns = array_merge(['edit', 'delete'], get_column($table->name));

        $context = [
            'columns' => $columns,
            'table' => $table->label,
        ];

        return view('pages.master.fetch', $context);
    }

    public function fetchOnServer(Request $request, string $code) {
        $table = TableCode::where('code', $code)->first();
        $columns = array_merge(['edit', 'delete'], get_column($table->name));
        return DataTables::of(DB::table($table->name)->limit(10))->with('columns', $columns)->make(true);
    }

    public function show(string $table, string $id)
    {
        dd($table);
    }

    public function edit(string $table, FormBuilder $builder)
    {
        return 'EDIT DI SINI';
    }

    public function update(Request $request, string $table, string $id)
    {
        \Log::create('Updated—'. $table .' ('. Str::uppert($id) .')');
    }

    public function destroy(string $table, string $id)
    {
        \Log::create('Deleted—'. $table .' ('. Str::upper($id) .')');
        $query = DB::table($table)->where('id', $id)->delete();

        if ($request->ajax()) {
            if (!$query) {
                Alert::error('Kesalahan', 'Coba lagi nanti.');
                return redirect()->back();
            }
            return response()->json(['code' => 200]);
        }

        Alert::success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
