<?php

namespace App\Http\Controllers;

use App\Jobs\SendInterviewSchedule;
use App\Jobs\SendInterviewReschedule;

use App\Models\Availability;
use App\Models\Candidate;
use App\Models\City;
use App\Models\Education;
use App\Models\InterviewSchedule;
use App\Models\Proposal;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
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
        abort(404);
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

    public function createSession(string $vacancy, string $candidate) {
    	$proposal = Proposal::where([
    		['vacancy_id', $vacancy],
    		['candidate_id', $candidate]
    	]);

    	if (!$proposal) {
    		alert()->error('Kesalahan', 'Pelamar tidak ditemukan.');
    		return redirect()->route('home.index');
    	}

    	$proposal = $proposal->first();

    	$context = [
    		'proposal' => $proposal
    	];

	    return view('pages.recruitment.form.schedule.create', $context);
    }

    public function storeSession(Request $request) {
    	$proposal = Proposal::find($request->proposal_id);
		$schedule = InterviewSchedule::create($request->all());

		$context = [
			'id' => $schedule->id,
			'candidate_name' => Str::upper($proposal->candidate->profile->name ?? '-'),
			'position' => Str::upper($proposal->vacancy->name ?? '-'),
			'interview_date' => day_indo_format($request->interview_date) . ', ' . date_indo_format($request->interview_date),
			'interview_time' => $request->interview_time,
			'interview_type' => $request->interview_type,
			'interview_location' => $request->interview_location,
			'person_in_charge' => $request->person_in_charge,
			'phone_number' => $request->phone_number,
			'description' => $request->description,
			'recipient' => Str::lower($proposal->candidate->profile->user->email)
		];

        dispatch(new SendInterviewSchedule($context));

    	alert()->success('Sukses', 'Sesi Wawancara dengan '. Str::upper($proposal->candidate->profile->name) .' berhasil DIJADWALKAN pada '. date_indo_format($request->interview_date) .' '. $request->interview_time .' WIB')->autoClose(false);
    	return redirect()->back()->with('code', 200);
    }

    public function editSession(string $id) {
        $schedule = InterviewSchedule::find($id);

        if (!$schedule) {
            alert()->error('Kesalahan', 'Sesi Wawancara tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $context = [
            'schedule' => $schedule
        ];

        return view('pages.homepage.reschedule', $context);
    }

    public function updateSession(Request $request, string $id) {
        $schedule = InterviewSchedule::find($id);

        if (!$schedule) {
            alert()->error('Kesalahan', 'Sesi Wawancara tidak ditemukan.');
            return redirect()->route('home.index');
        }

        // RESCHEDULE-UPDATES
        // ======================================================================
        $reschedule = $schedule->replicate();
        $reschedule->interview_date = $request->interview_date;
        $reschedule->interview_time = $request->interview_time;
        $reschedule->interview_sequence += 1;
        $reschedule->has_changed = 0;
        $reschedule->status = 9;
        $reschedule->save();

        // SCHEDULE-UPDATES
        // ======================================================================
        $schedule->has_changed = 1;
        $schedule->status = 3;
        $schedule->save();

        alert()->success('Sukses', 'Permintaan reschedule sesi wawancara berhasil dilakukan, mohon menunggu balasan.')->autoClose(false);
        return redirect()->route('portal.show', $schedule->proposal->vacancy->slug);
    }

    public function createRescheduleSession(string $id) {
        $reschedule = InterviewSchedule::find($id);

        if (!$reschedule) {
            alert()->error('Kesalahan', 'Sesi Wawancara tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $context = [
            'reschedule' => $reschedule
        ];

        return view('pages.recruitment.form.schedule.edit', $context);
    }

    public function storeRescheduleSession(Request $request, string $id) {
        $schedule = InterviewSchedule::find($id);

        // RESCHEDULE-UPDATES
        // ======================================================================
        $reschedule = $schedule->replicate();
        $reschedule->interview_date = $request->interview_date;
        $reschedule->interview_time = $request->interview_time;
        $reschedule->interview_type = $request->interview_type;
        $reschedule->interview_location = $request->interview_location;
        $reschedule->interview_sequence += 1;
        $reschedule->has_changed = 0;
        $reschedule->status = 0;
        $reschedule->save();

        // SCHEDULE-UPDATES
        // ======================================================================
        $schedule->has_changed = 1;
        $schedule->status = 5;
        $schedule->save();

        $context = [
            'id' => $reschedule->id,
            'candidate_name' => $request->candidate_name,
            'position' => $request->position,
            'interview_date' => day_indo_format($request->interview_date) . ', ' . date_indo_format($request->interview_date),
            'interview_time' => $request->interview_time,
            'interview_type' => $request->interview_type,
            'interview_location' => $request->interview_location,
            'person_in_charge' => $reschedule->person_in_charge,
            'phone_number' => $reschedule->phone_number,
            'description' => $reschedule->description,
            'recipient' => Str::lower($reschedule->proposal->candidate->profile->user->email)
        ];

        dispatch(new SendInterviewReschedule($context));

        alert()->success('Sukses', 'Sesi Wawancara dengan '. $request->candidate_name .' berhasil DIJADWALKAN ULANG pada '. date_indo_format($request->interview_date) .' '. $request->interview_time .' WIB')->autoClose(false);
        return redirect()->back()->with('code', 200);
    }

    public function declineRescheduleSession(string $id) {
        $reschedule = InterviewSchedule::find($id);

        if (!$reschedule) {
            alert()->error('Kesalahan', 'Sesi Wawancara tidak ditemukan.');
            return redirect()->route('home.index');
        }

        $reschedule->has_changed = 1;
        $reschedule->status = 2;
        $reschedule->save();

        alert()->success('Sukses', 'Reschedule Sesi Wawancara ditolak.');
        return redirect()->back()->with('code', 200);
    }
}
