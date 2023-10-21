<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertWordToPDF;
use App\Jobs\SendOfferingLetter;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use App\Models\InterviewScore as Score;
use App\Models\OfferingLetter;
use App\Models\Proposal;
use App\Models\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offerings = OfferingLetter::all();
        $context = [
            'offerings' => $offerings
        ];
        return view('pages.contract.index', $context);
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
    public function show(Contract $contract)
    {
        //
    }

    public function generate(Request $request) {
        $request->validate(
            ['generated' => 'required'],
            ['generated.required' => 'Mohon beri tanda (☑) pada kolom yang tersedia.']
        );

        $destination = 'PKWT/templates/';

        // ADJUSTABLE
        $template = Template::find('00000000-0000-0000-0000-000000000000')->name;

        if (!$template) {
            $template = Template::find('00000000-0000-0000-0000-000000000000')->name;
        }

        $zip = new \ZipArchive;
        $zip_name = 'PKWT_' . date('Ymd_His') . '_' . count($request->generated) . '.zip';

        if ($zip->open(storage_path($zip_name), \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            foreach ($request->generated as $id) {
                $offering = OfferingLetter::find($id);

                if (!$offering) {
                    alert()->error('Kesalahan', 'Data tidak ditemukan.');
                    return redirect()->route('contract.index');
                }

                $prefix = $offering->score->schedule->proposal->vacancy->type->initial ?? 'B';
                $region = $offering->score->schedule->proposal->vacancy->region->code ?? '02';

                $new_id = $prefix . $region . date('y') . '001';
                $new_number = '001';

                $found = Employee::whereRaw('SUBSTR(card_number, 4, 2) = CONCAT(DATE_FORMAT(now(), "%y"))')->latest()->first();
                if ($found) {
                    $new_id = fresh_card_number($prefix, $region, $found->card_number);
                    $new_number = incerement_card_number($found->card_number);
                }

                $header = $offering->score->schedule->proposal->vacancy->header_number ?? '-';
                $candidate_name = $offering->score->schedule->proposal->candidate->profile->name ?? '-';
                $placement = $offering->score->placement_to_be ?? '-';

                $head = $new_number . '/' . $header . '/' . month_to_rome(date('n')) . '/' . date('Y');

                $incerement = Str::of($header)->explode('/');
                $match = 'PKWT-1';
                foreach ($incerement as $value) {
                    if (Str::contains($value, 'PKWT')) {
                        $matched = $value;
                        break;
                    }
                }

                $department = $request->department_name;
                if ($request->has('department_name')) {
                    if (!is_numeric($request->department_name)) {
                        $department = Department::create(['name' => $request->department_name]);
                    } else {
                        $department = Department::find($request->department_name);
                    }
                }

                $contracted = Contract::where('offering_letter_id', $id)->first();

                if ($contracted) {
                    $contracted->department_id = $department->id;
                    $contracted->generated_count += 1;
                    $contracted->save();
                } else {
                    Contract::create([
                        'offering_letter_id' => $id,
                        'header_number' => $head,
                        'initial_card_number' => $new_id,
                        'department_id' => $department->id,
                        'take_home_pay' => ($offering->score->first_salary + $offering->score->second_salary),
                        'starting_date' => $offering->score->starting_date,
                        'ending_date' => $offering->score->ending_date,
                        'generated_count' => 1,
                        'status' => 1
                    ]);
                }

                if ($request->has('template')) {
                    $file = Str::snake(Str::upper($request->file('template')->getClientOriginalName()));
                    $template = pathinfo($file, PATHINFO_FILENAME) . '_' . strtotime('now') . '.' . $request->file('template')->getClientOriginalExtension();
                    $request->file('template')->storeAs($destination, $template, 'public');
                }

                $base = storage_path('app/public/PKWT/templates/' . $template);
                $writer = new TemplateProcessor($base);

                $writer->setValues([
                    'NOMOR_UNIK_PKWT' => $head,
                    'NAMA_KANDIDAT' => Str::upper($candidate_name ?? '-'),
                    'NAMA_KANDIDAT_BESAR' => Str::upper($candidate_name ?? '-'),
                    'NAMA_KANDIDAT_KECIL' => Str::upper($candidate_name ?? '-'),
                    'TEKS_HARI' => number_string(date('w')),
                    'TEKS_TANGGAL' => number_string(date('j')),
                    'TEKS_BULAN' => number_string(date('n')),
                    'TEKS_TAHUN' => number_string(date('Y')),
                    'TANGGAL_LENGKAP' => date('Y/m/d'),
                    'ID_KARYAWAN_BARU' => $new_id,
                    'NOMOR_KTP' => $offering->score->schedule->proposal->candidate->profile->national_number,
                    'TEMPAT_LAHIR' => Str::upper($offering->score->schedule->proposal->candidate->profile->place_of_birth ?? '-'),
                    'TANGGAL_LAHIR' => Str::upper(date_indo_format($offering->score->schedule->proposal->candidate->profile->date_of_birth ?? '-') ?? '-'),
                    'JENIS_KELAMIN' => Str::upper($offering->score->schedule->proposal->candidate->profile->gender->name ?? '-'),
                    'ALAMAT_LENGKAP' => Str::upper($offering->score->schedule->proposal->candidate->profile->current_address ?? '-'),
                    'NAMA_JABATAN' => Str::upper($offering->score->schedule->proposal->vacancy->name ?? '-'),
                    'NAMA_DEPARTEMEN' => Str::upper($department->name ?? '-'),
                    'NAMA_MITRA' => Str::upper($offering->score->schedule->proposal->vacancy->project->partner->name ?? '-'),
                    'LOKASI_KERJA' => Str::upper($placement ?? '-'),
                ]);

                $filename = storage_path('app/public/PKWT/' . Str::snake(Str::lower($candidate_name)) . '.docx');

                $writer->saveAs($filename);

                $converter = new OfficeConverter($filename, storage_path('app/public/PKWT/'), 'soffice', false);
                $converter->convertTo($id . '.pdf');

                $zip->addFile(storage_path('app/public/PKWT/' . $id . '.pdf'), Str::snake(Str::lower($candidate_name)) . '_' . date('m') . '_' . date('Y') . '.pdf');

                unlink($filename);
            }
            $zip->close();
        } else {
            alert()->error('Kesalahan', 'Permintaan ditolak.');
            return redirect()->back()->with('code', 369);
        }

        foreach ($request->generated as $element) {
            unlink(storage_path('app/public/PKWT/' . $element . '.pdf'));
        }

        dispatch(new ConvertWordToPDF());

        alert()->success('Sukses', '[' . count($request->generated) . '] PKWT Digital berhasil dibuat.');
        return response()->download(storage_path($zip_name))->deleteFileAfterSend(true);
    }

    public function download(string $path) {
        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function signed() {
        return view('pages.contract.signed');
    }

    public function signedContract(Request $request) {
        return 'Validate';
    }

    public function offering() {
        $offerings = Score::where('status', 1)
        ->whereDoesntHave('offered')->get();

        $context = [
            'offerings' => $offerings
        ];

        return view('pages.contract.offering', $context);
    }

    public function sendOffering(Request $request) {
        $request->validate(['offered' => 'required']);

        foreach ($request->offered as $data) {
            $score = Score::find($data);

            if (!$score) {
                alert()->error('Kesalahan', 'Data tidak ditemukan.');
                return redirect()->back()->with('code', 347);
            }

            $offering = OfferingLetter::create([
                'interview_score_id' => $score->id,
                'expired_at' => date('Y-m-d H:i:s', strtotime('+7 days')),
                'status' => 0,
                'has_changed' => 0
            ]);

            $context = [
                'id' => $offering->id,
                'candidate_name' => Str::upper($score->schedule->proposal->candidate->profile->name ?? '-'),
                'position' => Str::upper($score->schedule->proposal->vacancy->name ?? '-'),
                'placement' => Str::upper($score->placement_to_be ?? '-'),
                'first_salary' => 'Rp'. money_indo_format($score->first_salary) . ',-',
                'second_salary' => 'Rp' . money_indo_format($score->second_salary) . ',-',
                'starting_date' => day_indo_format($score->starting_date) . ', ' . date_indo_format($score->starting_date),
                'ending_date' => day_indo_format($score->ending_date) . ', ' . date_indo_format($score->ending_date),
                'expired_at' => date_indo_format($offering->expired_at),
                'recipient' => Str::lower($score->schedule->proposal->candidate->profile->user->email)
            ];

            dispatch(new SendOfferingLetter($context));
        }

        alert()->success('Sukses', 'Offering Letter terkirim pada ' . count($request->offered) . ' kandidat.');
        return redirect()->back()->with('code', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
