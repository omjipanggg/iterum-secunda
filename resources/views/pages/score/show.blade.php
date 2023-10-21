@extends('layouts.panel')
@section('title', 'Penilaian: ' . Str::upper($schedule->id))
@section('content')
<div class="container-fluid px-12">
	<div class="row g-4">
		<div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('score.show', $schedule) }}
                </div>
            </div>
		</div>
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <div class="group">
                            <i class="bi bi-bar-chart-line me-2"></i>
                            @yield('title')
                        </div>
                        <a href="{{ route('score.store', $schedule->id) }}" onclick="triggerClick(event, '#btn-submit-on-scoring');" class="btn btn-outline-color btn-sm px-3">
                            Simpan
                            <i class="bi bi-save ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary rounded-0" role="alert">
                        <p class="fw-semibold">
                            <i class="bi bi-info-circle me-2"></i>
                            Informasi
                        </p>
                        <p class="mb-1"><span class="fw-semibold w-90 d-inline-block">Sesi Wawancara</span>{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }}</p>
                        <p class="mb-1"><span class="fw-semibold w-90 d-inline-block">Lowongan Kerja</span><a href="{{ route('vacancy.show', $schedule->proposal->vacancy->id) }}" class="alert-link" target="_blank"><em>{{ Str::upper($schedule->proposal->vacancy->project->project_number) }}</em> &middot; {{ Str::upper($schedule->proposal->vacancy->name) }} &middot; {{ Str::upper($schedule->proposal->vacancy->placement) }}</a></p>
                        <hr>
                        <p class="mb-0"><span class="fw-semibold w-90 d-inline-block">Data Pelamar</span><a href="{{ route('recruitment.show', $schedule->proposal->candidate->id) }}" class="alert-link" target="_blank">{{ Str::upper($schedule->proposal->candidate->profile->name) }}</a> ({{ Str::lower($schedule->proposal->candidate->profile->primary_email) }}/{{ $schedule->proposal->candidate->profile->phone_number }})</p>
                    </div>

                    <form action="{{ route('score.store', $schedule->id) }}" id="formScoring" method="POST">
                        @csrf
                        @method('POST')
                        <h6 class="mb-1 mt-4">[P1-P6] Personalia</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover no-info align-top">
                                <thead>
                                    <tr>
                                        <th class="pe-4">[P1] Kepribadian</th>
                                        <th class="pe-4">[P2] Kerja tim</th>
                                        <th class="pe-4">[P3] Kepemimpinan</th>
                                        <th class="pe-4">[P4] Daya tangkap</th>
                                        <th class="pe-4">[P5] Motivasi kerja</th>
                                        <th class="pe-4">[P6] Ketertarikan pada<br>bidang pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="personality" id="personality" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->personality ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="teamwork" id="teamwork" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->teamwork ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="leadership" id="leadership" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->leadership ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="comperhension" id="comperhension" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->comperhension ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="work_motivation" id="work_motivation" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->work_motivation ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="interest_in_work" id="interest_in_work" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->interest_in_work ?? null }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mb-1 mt-4">[Q1-Q6] Kemampuan</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover no-info align-top">
                                <thead>
                                    <tr>
                                        <th class="pe-4">[Q1] Komputer dasar</th>
                                        <th class="pe-4">[Q2] Komputer lanjutan</th>
                                        <th class="pe-4">[Q3] Bahasa asing</th>
                                        <th class="pe-4">[Q4] Pemahaman pada<br>bidang pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="computer_basic" id="computer_basic" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->computer_basic ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="computer_advance" id="computer_advance" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->computer_advance ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="linguistics" id="linguistics" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->linguistics ?? null }}"></td>
                                        <td><input type="number" required="" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="work_knowledge" id="work_knowledge" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $schedule->score->work_knowledge ?? null }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @php($has_test=true)
                        @if ($has_test)
                        @php($tests = [['id' => 1, 'name' => 'Tes DISC', 'score' => 'disc.xlsx'], ['id' => 2, 'name' => 'Tes Excel', 'score' => 40], ['id' => 3, 'name' => 'Tes Keamanan', 'score' => 'result.xlsx']])
                        <h6 class="mb-1 mt-4">[R1-R{{ count($tests) }}] Tes Mandiri</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover no-info align-top">
                                <thead>
                                    <tr>
                                    @foreach ($tests as $test)
                                        <th class="pe-4">[R{{ $loop->iteration }}] {{ $test['name'] }}</th>
                                    @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    @foreach ($tests as $test)
                                        <td>{{ $test['score'] }}</td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @php($salary=null)
                        @php($suitable=null)
                        @php($placement=null)
                        @php($notes=null)
                        @if ($schedule->score)
                            @php($salary=money_indo_format($schedule->score->first_salary+$schedule->score->second_salary))
                            @php($suitable=$schedule->score->suitability)
                            @php($placement=Str::upper($schedule->score->placement_to_be))
                            @php($notes=$schedule->score->private_notes)
                        @endif
                        <h6 class="mb-2 mt-4">Tambahan</h6>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <div class="show-placeholder flex-basis-4">
                                <div class="form-floating">
                                    <input type="number" autocomplete="off" oninput="oneChar(this);" class="form-control form-control-sm" maxlength="1" name="suitability" id="suitability" min="1" max="5" pattern="[1-5]" placeholder="Skala 1-5" value="{{ $suitable }}" required="">
                                    <label for="suitability" class="fw-semibold small">Kecocokan</label>
                                </div>
                            </div>
                            <div class="show-placeholder flex-basis-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-money" autocomplete="off" oninput="typingMoney(event);" id="salary_temp" placeholder="{{ money_indo_format($schedule->proposal->candidate->expected_salary) }}" name="salary" value="{{ $salary }}" required="">
                                    <label for="salary_temp" class="fw-semibold small">Upah yang disepakati</label>
                                </div>
                            </div>
                            <div class="show-placeholder flex-basis-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" autocomplete="off" name="placement_to_be" id="placement_to_be" placeholder="{{ Str::upper($schedule->proposal->vacancy->placement) }}" value="{{ $placement }}" required="">
                                    <label for="placement_to_be" class="fw-semibold small">Kota Penempatan</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <div class="form-date-floating flex-basis-6">
                                <input type="date" class="form-control" autocomplete="off" name="starting_date" id="starting_date" value="{{ $schedule->score->starting_date ?? $schedule->proposal->vacancy->project->starting_date }}">
                                <span class="fw-semibold small">Tgl. Awal Kontrak</span>
                            </div>
                            <div class="form-date-floating flex-basis-6">
                                <input type="date" class="form-control" autocomplete="off" name="ending_date" id="ending_date" value="{{ $schedule->score->ending_date ?? $schedule->proposal->vacancy->project->ending_date }}">
                                <span class="fw-semibold small">Tgl. Akhir Kontrak</label>
                            </div>
                        </div>

                        <textarea name="private_notes" id="private_notes" cols="30" rows="10" id="private_notes" class="editor-with-placeholder" data-bs-content="{{ $notes }}" data-bs-placeholder="<p>Catatan</p>">{!! html_entity_decode($notes) !!}</textarea>

                        <button class="btn btn-color d-none" id="btn-submit-on-scoring">Kirim</button>
                    </form>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Mohon isi semua kolom yang tersedia.
                </div>
            </div>
        </div>
	</div>
</div>
@endsection