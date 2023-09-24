<?php

namespace App\Http\Controllers;

use App\Jobs\SendSubscription;
use App\Jobs\SendStorageToCloud as Cloud;

use App\Mail\SendSubscription as SendMailable;

use App\Models\InterviewSchedule;
use App\Models\User;
use App\Models\Profile;
use App\Models\Vacancy;
use App\Models\VacancyCategory as Category;

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
        $categories = Category::withCount(['vacancies' => function($query) {
                $query->where([
                    ['closing_date', '>=', today()],
                    ['active', true]
                ]);
            }])->take(8)
        // ->inRandomOrder()
        ->orderByDesc('vacancies_count')
        ->orderBy('name')
        ->get();

        $vacancies = Vacancy::withCount('candidates')->where([
            ['closing_date', '>=', today()],
            ['active', true]
        ])->orderByDesc('published_at')->take(5)->get();

        $context = [
            'categories' => $categories,
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

    public function download(string $path, string $file) {
        $directory = implode('/', json_decode($path));
        $target = storage_path('app/public/' . $directory . '/' . $file);

        if (!file_exists($target)) {
            alert()->error('Kesalahan', 'Berkas tidak ditemukan.');
            return redirect()->back()->with('code', 412);
        }

        if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf' || pathinfo($file, PATHINFO_EXTENSION) == 'PDF') {
            return response()->file($target, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $file . '"'
            ]);
        }

        return response()->download($target);
    }

    public function preview(string $id) {
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

    public function report() {
        alert()->info('Informasi', 'Dalam tahap pengembangan.');
        return redirect()->back();
    }

    public function sendStorageToCloud(Request $request) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        Cloud::dispatch($fileName, $file);
        return redirect()->back()->with('code', 200);
    }

    // CANDIDATE-RESPONDED-THROUGH-EMAIL
    // ========================================================================
    public function scheduleResponse(string $id, string $response) {
        $schedule = InterviewSchedule::find($id);

        if (!$schedule) {
            alert()->error('Kesalahan', 'Laman tidak ditemukan.');
            return redirect()->route('home.index');
        }

        if ($schedule->has_changed) {
            alert()->error('Kesalahan', 'Anda sudah memberikan jawaban pada '. date_time_indo_format($schedule->updated_at) .' WIB');
            return redirect()->route('portal.show', $schedule->proposal->vacancy->slug);
        }

        $answer = false;
        if ($response < 3) {
            $answer = true;
        } else if ($response == 3) {
            alert()->info('Perhatian', 'Silakan isi sesi wawancara yang Anda kehendaki.');
            return redirect()->route('schedule.editSession', $schedule->id);
        } else {
            alert()->error('Kesalahan', 'Parameter tidak diketahui.');
            return redirect()->route('portal.show', $schedule->proposal->vacancy->slug);
        }

        if ($answer) {
            $schedule->has_changed = 1;
            $schedule->status = $response;
            $schedule->save();
        }

        alert()->success('Sukses', 'Terima kasih atas jawaban Anda.');
        return redirect()->route('portal.show', $schedule->proposal->vacancy->slug);
    }
}