@extends('layouts.panel')
@section('title', 'Sesi Wawancara')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('schedule.index') }}
                </div>
            </div>
		</div>
	</div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div class="wrap">
                            <i class="bi bi-calendar2-day me-2"></i>
                            @yield('title')
                        </div>
                        <a href="#" class="btn btn-outline-color px-3">
                            Tambah
                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="no-wrap table table-bordered table-sm table-hover fetch">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Status</th>
                                    <th colspan="4">Sesi Wawancara</th>
                                    <th rowspan="2">Lowongan Kerja</th>
                                    <th rowspan="2">Kota Penempatan</th>
                                    <th rowspan="2">Wilayah</th>
                                    <th rowspan="2">Nama Pelamar</th>
                                    <th rowspan="2">Alamat email</th>
                                    <th rowspan="2">No. Telepon</th>
                                </tr>
                                <tr>
                                    <th>Hari/Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Tipe</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($schedule->score)
                                            @php($param=['color' => 'success', 'icon' => 'check-circle', 'label' => 'sudah dinilai'])
                                        @else
                                            @php($param=['color' => 'dark', 'icon' => 'question-circle', 'label' => 'belum dinilai'])
                                        @endif
                                        <span class="badge text-bg-{{ $param['color'] }} py-1 rounded-0"><i class="bi bi-{{ $param['icon'] }} me-2"></i>{{ $param['label'] }}</span>
                                    </td>
                                    <td class="@if($schedule->status != 1) text-decoration-line-through @endif">{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }}</td>
                                    <td>{{ $schedule->interview_time }}</td>
                                    <td>{{ $schedule->interview_type }}</td>
                                    <td>
                                        @if ($schedule->interview_type == 'Online')
                                        <a href="{{ $schedule->interview_location }}" target="_blank" class="dotted">Buka<i class="bi bi-box-arrow-up-right ms-1"></i></a>
                                        @else
                                        {{ $schedule->interview_location ?? '-' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('vacancy.show', $schedule->proposal->vacancy->id) }}" class="dotted" target="_blank">
                                        <em>{{ $schedule->proposal->vacancy->project->project_number ?? '-' }}</em><span class="mx-1">&middot;</span>{{ Str::upper($schedule->proposal->vacancy->name) ?? '-' }}</a>
                                    </td>
                                    <td>{{ Str::upper($schedule->proposal->vacancy->placement ?? '-') }}</td>
                                    <td class="fw-semibold">{{ Str::upper($schedule->proposal->vacancy->region->slug ?? '-') }}</td>
                                    <td>
                                        <a href="{{ route('recruitment.show', $schedule->proposal->candidate->id) }}" class="dotted" target="_blank">
                                            {{ Str::upper($schedule->proposal->candidate->profile->name ?? '-') }}
                                        </a>
                                    </td>
                                    <td>{{ Str::lower($schedule->proposal->candidate->profile->primary_email ?? '-') }}</td>
                                    <td>{{ $schedule->proposal->candidate->profile->phone_number ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Hari/Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Tipe</th>
                                    <th>Lokasi</th>
                                    <th>Lowongan Kerja</th>
                                    <th>Kota Penempatan</th>
                                    <th>Wilayah</th>
                                    <th>Nama Pelamar</th>
                                    <th>Alamat email</th>
                                    <th>No. Telepon</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Data yang ditampilkan sudah melalui tahap transformasi.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection