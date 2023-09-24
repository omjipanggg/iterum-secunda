@extends('layouts.plain')
@section('title', 'Reschedule')
@section('content')
<div class="container" id="reschedule">
	<div class="row align-items-center h-100">
		<div class="col-lg-6 offset-lg-3">
			<div class="p-3">
				@if ($errors->any())
				<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
					<i class="bi bi-info-circle me-2"></i><strong>Perhatian!</strong> Mohon isi semua kolom yang tersedia.
				    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	            </div>
	            @else
				<div class="alert alert-warning alert-dismissible fade show mb-2 rounded-0" role="alert">
					<i class="bi bi-info-circle me-2"></i><strong>Perhatian!</strong> Anda hanya dapat mengubah sesi wawancara sebanyak <strong>1</strong> kali.
	                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	            </div>
	            @endif
				<form action="{{ route('schedule.updateSession', $schedule->id) }}" method="POST" id="formReschedule">
				@csrf
				@method('POST')
				<div class="d-flex gap-2 flex-wrap flex-column">
	                <div class="form-date-floating flex-fill">
	                    <input type="date" id="reschedule_interview_date" name="interview_date" autocomplete="off" placeholder="{{ date_indo_format($schedule->interview_date) }}" class="@error('interview_date') is-invalid @enderror form-control" min="{{ date('Y-m-d', strtotime(today() . "+ 1 day")) }}" max="{{ date('Y-m-d', strtotime($schedule->interview_date . "+ 5 days")) }}" data-interview-date="{{ $schedule->interview_date }}" required="">
	                    <span for="reschedule_interview_date" class="fw-semibold small" value="{{ $schedule->interview_date }}">Tgl. Reschedule</span>
	                </div>
	                <div class="form-date-floating flex-fill">
	                    <input type="time" id="interview_time" name="interview_time" autocomplete="off" placeholder="{{ $schedule->interview_time }}" class="@error('interview_time') is-invalid @enderror flatpickr-hand form-control" value="{{ $schedule->interview_time }}" required="">
	                    <span for="interview_time" class="fw-semibold small">Waktu Reschedule</span>
	                </div>
					<button type="submit" class="btn btn-color btn-lg px-3 rounded-0">Kirim<i class="bi bi-send ms-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection