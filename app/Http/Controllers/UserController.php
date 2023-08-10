<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog as Log;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified', 'restricted']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [
            'users' => User::orderByDesc('created_at')->get()
            // 'users' => User::withTrashed()->orderByDesc()->get()
        ];
        return view('pages.master.user.index', $context);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            if (is_numeric($role)) {
                $user->roles()->attach($role);
            } else {
                $roles = Role::create(['name' => $role]);
                $user->roles()->attach($roles);
            }
        }

        Log::create('User updated—' . $user->id);
        Alert::success('Sukses', 'Data Pengguna berhasil diubah.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->email = strtotime("now") . '_' . $user->email;
        $user->save();
        Log::create('User deleted—' . $user->id);
        // $user->roles()->detach();
        $user->delete();
        Alert::success('Sukses', 'Data Pengguna berhasil dihapus.');
        return redirect()->back();
    }
}
