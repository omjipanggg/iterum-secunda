<?php

namespace App\Http\Controllers;

use App\Forms\Insert;
use App\Forms\Edit;

use App\Imports\Spreadsheet;

use App\Jobs\SendRegister;

use App\Models\Menu;
use App\Models\RequestToken;
use App\Models\Role;
use App\Models\TableCode;
use App\Models\User;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class WebMasterController extends Controller
{
    protected $tables;

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'restricted']);
    }

    public function generateTable() {
        $this->tables = generate_table_code();
        Alert::success('Sukses', 'Konfigurasi tabel selesai.');
        return redirect()->route('master.index');
    }

    public function sendRegisterLink(Request $request) {
        foreach ($request->recipients as $recipient) {
            $token = RequestToken::create([
                'email' => $recipient,
                'hash' => Str::random(36),
                'expired_at' => Carbon::now()->addMinutes(60)
            ]);
            SendRegister::dispatch($token);
        }

        Alert::success('Sukses', "Berhasil mengirim " . count($request->recipients) . " pesan.");
        return redirect()->back();
    }

    public function index()
    {
        $context = [];
        return view('pages.master.index', $context);
    }

    public function create(string $code, FormBuilder $builder)
    {
        $table = TableCode::where('code', $code)->first();

        $form = $builder->create(Insert::class, [
            'method' => 'POST',
            'url' => route('master.store', $code),
            'model' => $table->name
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
            \Log::create('Stored_'. $table->name . '_table');
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

        // $model = '\\App\\Models\\' . \Str::studly(\Str::singular($table->name));
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

        $data = DB::table($table->name)->limit(10);
        return DataTables::of($data)->with([
            'columns' => $columns,
            'columnTypes' => $columnTypes
        ])->toJson();
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

    public function createMenu() {
        $menu = Menu::where('active', 1)->orderBy('order_number')->get();
        $roles = Role::all();
        $context = [
            'menu' => $menu,
            'roles' => $roles
        ];
        return view('pages.master.menu.index', $context);
    }

    public function storeMenu(Request $request) {
        // dd($request->all());
        if (!$request->has('menu') || !$request->has('roles')) {
            Alert::error('Kesalahan', 'Mohon isi semua kolom yang tersedia.');
            return redirect()->back()->with(['code', 503]);
        }

        foreach ($request->roles as $role) {
            Role::find($role)->menu()->detach();
            foreach ($request->menu as $menu) {
                Role::find($role)->menu()->attach($menu);
            }
        }

        Alert::success('Sukses', 'Hak Akses berhasil disesuaikan.');
        return redirect()->back()->with(['code' => 200]);
    }

    public function show(string $table, string $id)
    {
        dd($table, $id);
    }

    public function edit(string $code, string $id, FormBuilder $builder)
    {
        $table = TableCode::where('code', $code)->first();

        $form = $builder->create(Edit::class, [
            'method' => 'PUT',
            'url' => route('master.update', [$code, $id]),
            'model' => $table->name,
            'data' => [
                'records' => DB::table($table->name)->where('id', $id)->get()
            ]
        ]);

        $context = ['form' => $form];

        return view('pages.master.edit', $context);
    }

    public function update(Request $request, string $code, string $id)
    {
        $table = TableCode::where('code', $code)->first();
        $query = DB::table($table->name)->where('id', $id)->update($request->except(['_method', '_token']));

        if (!$query) {
            Alert::error('Kesalahan', 'Data gagal diubah.');
            return redirect()->back();
        }

        \Log::create('Updated_'. $table->name .'_table('. Str::upper($id) .')');

        Alert::success('Sukses', 'Data berhasil diubah.');
        return redirect()->back();
    }

    public function destroy(Request $request, string $code, string $id)
    {
        $table = TableCode::where('code', $code)->first();

        \Log::create('Deleted—'. $table->name .' ('. Str::upper($id) .')');

        Schema::disableForeignKeyConstraints();
        $query = DB::table($table->name)->where('id', $id)->delete();
        Schema::enableForeignKeyConstraints();

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
        return redirect()->back()->with('code', 401);
    }
}
