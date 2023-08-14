<?php

namespace App\Http\Controllers;

use App\Forms\Insert;
use App\Forms\Edit;

use App\Imports\Spreadsheet;

use App\Models\TableCode;
use App\Models\User;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class WebMasterController extends Controller
{
    protected $table_codes;

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'restricted']);
    }

    public function generateTable() {
        $this->table_codes = generate_table_code();
        Alert::success('Sukses', 'Konfigurasi selesai.');
        return redirect()->route('master.index');
    }

    public function index(FormBuilder $builder)
    {
        $context = [
            'tables' => TableCode::all(),
            'users' => User::all()
        ];
        return view('pages.master.index', $context);
    }

    public function create(string $code, FormBuilder $builder)
    {
        $table = TableCode::where('code', $code)->first();

        $form = $builder->create(Insert::class, [
            'method' => 'POST',
            'url' => route('master.store', $code),
            'model' => $table->name,
        ]);

        $context = ['form' => $form];

        return view('pages.master.create', $context);
    }

    public function store(Request $request, string $code)
    {
        $table = TableCode::where('code', $code)->first();

        $query = DB::table($table->name)->insert($request->except(['_method', '_token']));

        Alert::error('Kesalahan', 'Data gagal ditambahkan.');
        if ($query) {
            \Log::create('Stored—'. $table->name);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
        }
        return redirect()->back();
    }

    public function fetch(string $code)
    {
        $table = TableCode::where('code', $code)->first();

        if (!$table) {
            Alert::error('Kesalahan', 'Model tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $model = '\\App\\Models\\' . \Str::studly(\Str::singular($table->name));
        $columns = array_merge(['edit', 'delete'], get_column_name($table->name));

        $records = DB::table($table->name)->get();

        $context = [
            'columns' => $columns,
            'table' => $table,
            'records' => $records
        ];

        return view('pages.master.fetch', $context);
    }

    public function fetchOnServer(Request $request, string $code) {
        $table = TableCode::where('code', $code)->first();
        $columns = array_merge(['edit', 'delete'], get_column_name($table->name));
        $columnTypes = array_merge(['edit', 'delete'], get_column_type($table->name));
        return DataTables::of(DB::table($table->name)->limit(10))->with('columns', $columns)->with('columnTypes', $columnTypes)->toJson();
    }

    public function import(string $code) {
        $table = TableCode::where('code', $code)->first();

        if (!$table) {
            Alert::error('Kesalahan', 'Model tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $context = [
            'action' => route('master.importOnServer', $code)
        ];

        return view('pages.master.form.upload', $context);
    }

    public function importOnServer(Request $request, string $code) {
        // $val = $request->validate(['file' => 'required|mimes:csv,json']);
        $table = TableCode::where('code', $code)->first();
        $model = '\\App\\Models\\' . Str::studly(Str::singular($table->name));

        $mimes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'];

        $extension = $request->file('file')->getClientOriginalExtension();

        if ($extension == 'csv') {
            $imported = Excel::import(new Spreadsheet($model), $request->file('file'));
        } else if ($extension == 'json') {
            $imported = false;
        } else {
            Alert::error('Kesalahan', 'Format berkas tidak sesuai.');
            return redirect()->back();
        }

        Alert::success('Sukses', 'Berhasil mengunggah data.');
        if (!$imported) {
            Alert::error('Kesalahan', 'Gagal mengunggah data.');
        }

        return redirect()->route('master.fetch', $code);
    }

    public function show(string $table, string $id)
    {
        dd($table);
    }

    public function edit(string $code, FormBuilder $builder)
    {
        return 'EDIT DI SINI';
    }

    public function update(Request $request, string $code, string $id)
    {
        \Log::create('Updated—'. $table .' ('. Str::upper($id) .')');
    }

    public function destroy(Request $request, string $code, string $id)
    {
        $table = TableCode::where('code', $code)->first();

        \Log::create('Deleted—'. $table->name .' ('. Str::upper($id) .')');

        $query = DB::table($table->name)->where('id', $id)->delete();

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

    public function destroyThem(Request $request) {
        Alert::warning('Perhatian', 'Mohon mencoba kembali.');
        return redirect()->back()->with('status', 401);
    }
}
