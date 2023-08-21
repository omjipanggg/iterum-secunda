<?php

namespace App\Http\Controllers;

use App\Jobs\SendSubscription;
use App\Jobs\UploadFile;

use App\Mail\SendSubscription as SendMailable;

use App\Models\User;
use App\Models\Profile;
use App\Models\Vacancy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Ftp as FtpAdapter;

use RealRashid\SweetAlert\Facades\Alert;

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
        $vacancies = Vacancy::withCount('candidates')->where([
            ['closing_date', '>=', today()],
            ['active', true]
        ])->orderByDesc('published_at')->take(5)->get();
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

        return redirect()->back()->with($path);
    }

    public function settings() {
        $context = [];
        return view('pages.homepage.settings', $context);
    }

    public function sitemap() {
        return view('pages.homepage.sitemap');
    }

    public function subscribe(Request $request) {
        SendSubscription::dispatch($request->email);
        // Mail::to($request->email)->send(new SendMailable($request->email));
        Alert::success('Sukses', 'Terima kasih telah berlangganan!');
        return redirect()->back();
    }

    public function unsubscribe(Request $request, string $email) {
        Alert::success('Sukses', 'Layanan telah dihentikan.');
        return redirect()->route('home.index');
    }

    public function lounge() {
        $context = [];
        return view('pages.homepage.lounge', $context);
    }

    public function search(Request $request) {
        dd($request->all());
    }

    public function faq() {
        $context = [];
        return view('pages.dashboard.faq', $context);
    }

    public function download(string $path, string $file) {
        $path = implode('/', json_decode($path));
        $target = storage_path('app/public/' . $path . '/' . $file);
        return response()->download($target);
    }

    public function downloadResume(string $id) {
        // $path = public_path('storage/candidate' . $directory . '/' . $id);
        $path = storage_path('app/public/profiles/resumes/' . $id);
        if (!file_exists($path)) {
            alert()->error('Kesalahan', 'Berkas tidak ditemukan.');
            return redirect()->back()->with('code', 403);
        }

        if (pathinfo($id, PATHINFO_EXTENSION) == 'pdf' || pathinfo($id, PATHINFO_EXTENSION) == 'PDF') {
            return response()->file($path, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $id . '"'
            ]);
        }
        return response()->download($path);
    }
}