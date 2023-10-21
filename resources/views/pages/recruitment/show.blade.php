@extends('layouts.panel')
@section('title', 'Seleksi: ' . $candidate->profile->name)
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('recruitment.show', $candidate) }}
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-binoculars-fill me-2"></i>
					Seleksi
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-sm fetch no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Tgl. Melamar</th>
									<th>Posisi</th>
									<th>Penempatan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@forelse($candidate->appliedTo as $applied)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ date_time_indo_format($applied->pivot->created_at) }}</td>
									<td><a href="{{ route('vacancy.show', $applied->id) }}" class="dotted fw-semibold" target="_blank">{{ Str::upper($applied->name) }}</a></td>
									<td>{{ Str::upper($applied->placement) }}</td>
									<td>
										@php($scheduled=false)
										@forelse ($candidate->interviewSchedules as $schedule)
											@if ($schedule->proposal->vacancy->id == $applied->id)
												@php($scheduled=true)
											@endif
										@empty
										@endforelse
										@if ($scheduled)
											@foreach ($candidate->interviewSchedules as $schedule)
												@if ($schedule->status == 0)
													<div class="px-1 text-bg-secondary">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Menunggu</span>
													</div>
												@elseif($schedule->status == 1)
													<div class="px-1 text-bg-success">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Dijadwalkan</span>
													</div>
												@elseif($schedule->status == 2)
													<div class="px-1 text-bg-danger">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Ditolak</span>
													</div>
												@elseif($schedule->status == 3)
													<div class="px-1 text-bg-warning">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Reschedule</span>
													</div>
												@elseif($schedule->status == 5)
													<div class="px-1 text-bg-orange">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Permintaan</span>
													</div>
												@elseif($schedule->status == 9)
													<div class="px-1 text-bg-color">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB | <a href="{{ route('reschedule.createSession', $schedule->id) }}" class="dotted text-white" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Sesi Wawancara" data-bs-type="Reschedule" onclick="event.preventDefault();">Terima</a> | <a href="{{ route('reschedule.declineSession', $schedule->id) }}" class="dotted text-white">Tolak</a>
													</div>
												@else
													<div class="px-1 text-bg-dark">
													{{ day_indo_format($schedule->interview_date) }}, {{ date_indo_format($schedule->interview_date) }} {{ $schedule->interview_time }} WIB
													<span class="mx-1">&middot;</span>
													<span>Kesalahan</span>
													</div>
												@endif
											@endforeach
										@else
											<a href="{{ route('schedule.createSession', [$applied->id, $candidate->id]) }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Sesi Wawancara" data-bs-type="Tambah" onclick="event.preventDefault();" class="dotted">Atur Sesi Wawancara</a>
										@endif
									</td>
								</tr>
								@empty
								<tr>
									<td>Belum ada lamaran</td>
								</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Tgl. Melamar</th>
									<th>Posisi</th>
									<th>Penempatan</th>
									<th>Status</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					Data
				</div>
			</div>
		</div>
	</div>
</div>
@endsection