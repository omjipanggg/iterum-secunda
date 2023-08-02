<?php

namespace App\Http\Controllers;

use App\Jobs\UploadFile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Ftp as FtpAdapter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.homepage.index');
    }

    public function check() {
    }

    public function upload(Request $request) {
        $request->validate(['file' => 'required']);

        $directory = 'uploads';
        if ($request->has('path')) {
            if (!is_array($request->path)) {
                $request->path = [$request->path];
            }
            $directory = implode('/', $request->path);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $path = $file->storeAs($directory, $fileName, 'public');
        /*
        if (file_exists($path)) {
            unlink($path)
        }
        */
        return redirect()->back()->with($path);
    }

    public function settings() {
        return view('pages.homepage.settings');
    }

    public function sitemap() {
        return view('pages.homepage.sitemap');
    }

    public function portal(Request $request) {
        dd($request);
        return view('pages.portal.index');
    }

    public function showPortal(string $id) {
        dd($id);
        return view('pages.portal.show');
    }
}