<?php

namespace App\Http\Controllers;

use App\Jobs\UploadFile;

use App\Models\User;
use App\Models\Vacancy;

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
        $users = User::all();
        $vacancies = Vacancy::withCount('candidates')->orderByDesc('published_at')->take(5)->get();
        $context = [
            'users' => $users,
            'vacancies' => $vacancies
        ];
        return view('pages.homepage.index', $context);
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

    public function subscription(Request $request) {
        dd($request->all());
        // return redirect()->back();
    }

    public function lounge() {
        $context = [];
        return view('pages.dashboard.lounge', $context);
    }

    public function search(Request $request) {
        dd($request->all());
    }
}