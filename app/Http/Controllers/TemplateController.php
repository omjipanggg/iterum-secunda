<?php

namespace App\Http\Controllers;

use App\Models\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [
            'templates' => Template::all(),
        ];
        return view('pages.template.index', $context);
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
        $request->validate(['template' => 'required']);
        $destination = 'PKWT/templates/';
        $file = Str::lower(Str::trim($request->file('template')->getClientOriginalName()));
        $filename = pathinfo($file, PATHINFO_FILENAME) . '-' . strtotime('now') . '.' . $request->file('template')->getClientOriginalExtension();
        $result = $request->file('template')->storeAs($destination, $filename, 'public');

        Template::create(['name' => $filename]);

        if (!$result) {
            Alert::error('Kesalahan', 'Gagal mengunggah Template PKWT.');
        } else {
            Alert::success('Sukses', 'Template PKWT berhasil diunggah.');
        }
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
