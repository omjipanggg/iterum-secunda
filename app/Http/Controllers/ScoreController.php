<?php

namespace App\Http\Controllers;

use App\Models\InterviewSchedule as Schedule;
use App\Models\InterviewScore as Score;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class ScoreController extends Controller
{
    protected $percentage = 75;

	public function __construct() {
		$this->middleware(['auth', 'has.dashboard', 'verified']);
	}

    public function index() {
    	$schedules = Schedule::where('status', 1)
    	->whereDoesntHave('score')
    	->orWhereHas('score', function($query) {
    		$query->where('status', 0);
    	})
    	->orderBy('interview_date')
    	->with([
    		'proposal.candidate.profile',
    		'proposal.vacancy.project',
    		'proposal.vacancy.region',
    		'score'
    	])->get();

    	$scores = Score::all();

    	$context = [
    		'scores' => $scores,
    		'schedules' => $schedules
    	];

    	return view('pages.score.index', $context);
    }

    public function create(string $id) {
    	$schedule = Schedule::find($id);

    	if (!$schedule) {
    		alert()->error('Kesalahan', 'Nilai tidak ditemukan.');
    		return redirect()->route('score.index');
    	}

    	$context = [];
    	return view('pages.score.create', $context);
    }

    public function store(Request $request, string $id) {
        $score = Score::updateOrCreate(['interview_schedule_id' => $id], $request->except(['salary']));

        $salary = Str::replace('.', '', $request->salary);

        $remaining = 100 - $this->percentage;

        $primary = $salary * $this->percentage / 100;
        $secondary = $salary * $remaining / 100;

        $score->percentage = $this->percentage;

        $score->first_salary = $primary;
        $score->second_salary = $secondary;

        $score->header_number = strtotime('now');

        $score->save();

        alert()->success('Sukses', 'Penilaian disimpan.');
        return redirect()->route('score.index');
    }

    public function show(string $id) {
    	$schedule = Schedule::find($id);

    	if (!$schedule) {
    		alert()->error('Kesalahan', 'Nilai tidak ditemukan.');
    		return redirect()->route('score.index');
    	}

    	$context = [
    		'schedule' => $schedule
    	];

    	return view('pages.score.show', $context);
    }

    public function detail(Request $request, string $id) {
        $schedule = Schedule::find($id);

    	if (!$schedule) {
    		alert()->error('Kesalahan', 'Nilai tidak ditemukan.');
    		return redirect()->route('score.index');
    	}

        $context = [
        	'schedule' => $schedule
        ];

        return view('pages.score.detail', $context);
    }

    public function response(string $id, string $response, string $reason) {
        $score = Score::where('interview_schedule_id', $id)->first();

        $name = Str::upper($score->schedule->proposal->candidate->profile->name);

        if (!$score) {
            $response = [
                'code' => 316,
                'icon' => 'error',
                'title' => 'Kesalahan',
                'text' => 'Nilai tidak ditemukan.'
            ];
            alert()->error('Kesalahan', 'Nilai tidak ditemukan.');
            return redirect()->back()->with($response);
        }

        $score->reason = $reason;
        $score->status = $response;
        $score->save();

        $text = 'berhasil masuk ke dalam daftar pemberian Offering Letter';
        if ($response != 1) {
            $text = 'ditolak';
        }

        alert()->success($name, 'Kandidat ' . $text . '.');
        return redirect()->back()->with('code', 200);
   }

    public function specialRequest(string $id) {
        alert()->succes('Sukses', 'Gas!');
        return redirect()->route('score.index');
    }
}
