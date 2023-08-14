<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Contract;
use App\Models\Employee;

use Illuminate\Http\Request;
use NcJoes\OfficeConverter\OfficeConverter;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        dd($request->all());

        $request->validate(
            ['id' => 'required'],
            ['id.required' => 'Mohon beri tanda ☑ pada kolom yang tersedia.']
        );

        $zip = new \ZipArchive;

        $zipName = 'PKWT-' . date('YmdHis') . '-' . $request->id->count() . '.zip';

        if ($zip->open(storage_path($zipName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            foreach ($request->id as $element) {
                $vacancy = Vacancy::whereHas('candidates', function($query) use($element) {
                    $query->where('id', $element);
                })->with('type')->first();

                $prefix = 'B';
                if ($vacancy) {
                    $prefix = $vacancy->type->initial;
                }

                $found = Employee::whereRaw('SUBSTR(card_number , 4, 2) = CONCAT(DATE_FORMAT(now(), "%y"))')->latest();

                $freshId = $prefix . $region . date('y') . '001';
                $freshNumber = '001';

                if ($found) {
                    $freshId = fresh_card_number($prefix, $region, $found->card_number);
                    $freshNumber = incerement_card_number($found->card_number);
                }

                unlink($filename . '.docx');

                $zip->addFile(storage_path('app/public/PKWT/' . $element . '.pdf'), Str::trim($name) . '-' . date('m') . '-' . date('Y') . '.pdf');
            }
            $zip->close();
        }

        foreach ($request->id as $element) {
            unlink(storage_path('app/public/PKWT/' . $element . '.pdf'));
        }

        return response()->download(storage_path($zipName))->deleteFileAfterSend(true);
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
