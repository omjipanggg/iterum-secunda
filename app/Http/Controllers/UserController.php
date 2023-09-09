<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified', 'restricted']);
    }

    public function index()
    {
        $context = [
            // 'users' => User::orderByDesc('created_at')->get()
            'users' => User::withTrashed()->orderByDesc('created_at')->get()
        ];
        return view('pages.master.user.index', $context);
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
        //
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->get();

        $context = [
            'user' => $user,
            'roles' => $roles
        ];

        return view('pages.master.user.form.edit', $context);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $data = $role;
            if (!is_numeric($role)) {
                $data = Role::create(['name' => $role]);
            }
            $user->roles()->attach($data);
        }

        \Log::create('Updated—users (' . Str::upper($user->id) . ')');
        Alert::success('Sukses', 'Data Pengguna diubah.');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->email = strtotime("now") . '_' . $user->email;
        $user->save();

        \Log::create('Deleted—users (' . Str::upper($user->id) . ')');
        // $user->roles()->detach();

        Schema::disableForeignKeyConstraints();
        $user->delete();
        Schema::enableForeignKeyConstraints();

        Alert::success('Sukses', 'Data Pengguna dihapus.');
        return redirect()->back();
    }
}
