<div class="d-flex flew-wrap gap-2 mb-3 flex-column">
	<div class="d-flex flex-wrap align-items-baseline">
		<span class="fw-semibold small w-90">Lowongan Kerja</span>
		<p class="m-0"><em>{{ Str::upper($reschedule->proposal->vacancy->project->project_number ?? '-') }}</em> <span class="mx-2">&middot;</span> {{ Str::upper($reschedule->proposal->vacancy->name ?? '-') }} <span class="mx-2">&middot;</span> {{ Str::upper($reschedule->proposal->vacancy->placement) }}</p>
	</div>
	<div class="d-flex flex-wrap align-items-baseline">
		<span class="fw-semibold small w-90">Nama Mitra</span>
		<p class="m-0">{{ Str::upper($reschedule->proposal->vacancy->project->partner->name ?? '-') }}</p>
	</div>
	<div class="d-flex flex-wrap align-items-baseline">
		<span class="fw-semibold small w-90">Nama Pelamar</span>
		<p class="m-0">{{ Str::upper($reschedule->proposal->candidate->profile->name ?? '-') }}</p>
	</div>
</div>

<form action="{{ route('reschedule.storeSession', $reschedule->id) }}" method="POST">
	@csrf
	@method('POST')
	<input type="hidden" value="{{ Str::upper($reschedule->proposal->candidate->profile->name ?? '-') }}" name="candidate_name">
	<input type="hidden" value="{{ Str::upper($reschedule->proposal->vacancy->name ?? '-') }}" name="position">
	<div class="d-flex gap-2 flex-wrap mb-2">
		<div class="form-date-floating flex-basis-6">
		    <input type="date" id="interview_date" name="interview_date" autocomplete="off" placeholder="Tanggal reschedule" class="@error('interview_date') is-invalid @enderror form-control" required="" min="{{ date('Y-m-d', strtotime(today() . "+ 1 day")) }}" max="{{ date('Y-m-d', strtotime($reschedule->interview_date . "+ 10 days")) }}" value="{{ $reschedule->interview_date }}">
		    <label for="interview_date">Tgl. Reschedule</label>
		</div>
		<div class="form-floating flex-basis-6">
		    <input type="time" id="interview_time" name="interview_time" autocomplete="off" placeholder="Waktu reschedule" class="@error('interview_time') is-invalid @enderror form-control" required="" value="{{ $reschedule->interview_time }}">
		    <label for="interview_time">Waktu Reschedule</label>
		</div>
	</div>
	<div class="d-flex gap-2 flex-wrap">
		<div class="form-select-floating flex-basis-6">
			<label for="interview_type">Tipe wawancara</label>
			<select name="interview_type" id="interview_type" required="" class="@error('interview_type') is-invalid @enderror form-control select2-single-modal">
				<option value="Online" @if($reschedule->interview_type == 'Online') selected="" @endif>Online</option>
				<option value="Offline" @if($reschedule->interview_type == 'Offline') selected="" @endif>Offline</option>
			</select>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" placeholder="Lokasi/Tautan" required="" value="{{ $reschedule->interview_location }}" name="interview_location" id="interview_location" class="@error('interview_location') is-invalid @enderror form-control"/>
			<label for="interview_location">Lokasi/Tautan</label>
		</div>
	</div>
	<button type="submit" class="btn btn-color btn-lg d-none" id="btn-modal">Kirim</button>
</form>