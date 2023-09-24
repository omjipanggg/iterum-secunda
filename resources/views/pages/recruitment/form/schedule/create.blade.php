<form action="{{ route('schedule.storeSession', [$proposal->vacancy_id, $proposal->candidate_id]) }}" method="POST">
	@csrf
	@method('POST')
	<input type="hidden" value="{{ $proposal->id }}" name="proposal_id">
	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-floating flex-basis-4">
			<input type="text" value="{{ Str::upper($proposal->vacancy->project->project_number ?? '-') }} | {{ Str::upper($proposal->vacancy->name ?? '-') }} | {{ Str::upper($proposal->vacancy->project->partner->name ?? '-') }}" id="vacancy_name" class="form-control" placeholder="Lowongan Kerja" onkeydown="noEditPlease(event);">
			<label for="vacancy_name" class="text-muted fw-semibold small">Lowongan Kerja</label>
		</div>
		<div class="form-floating flex-basis-4">
			<input type="text" value="{{ Str::upper($proposal->vacancy->placement) }}" id="placement_on_modal" class="form-control" placeholder="Kota Penempatan" onkeydown="noEditPlease(event);">
			<label for="placement_on_modal" class="text-muted fw-semibold small">Kota Penempatan</label>
		</div>
		<div class="form-floating flex-basis-4">
			<input type="text" value="{{ Str::upper($proposal->candidate->profile->name ?? '-') }}" id="candidate_name" class="form-control" placeholder="Nama Pelamar" onkeydown="noEditPlease(event);">
			<label for="candidate_name" class="text-muted fw-semibold small">Nama Pelamar</label>
		</div>
	</div>

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-date-on-modal-floating flex-basis-6">
			<span class="text-muted fw-semibold small">Tanggal Wawancara</span>
			<input type="date" class="form-control" name="interview_date" id="interview_date" autocomplete="off" placeholder="{{ date_indo_format(date('Y-m-d')) }}" required="">
		</div>
		<div class="form-date-on-modal-floating flex-basis-6">
			<span class="text-muted fw-semibold small">Waktu Wawancara</span>
			<input type="time" class="form-control flatpickr-hand" name="interview_time" id="interview_time" autocomplete="off" placeholder="{{ date('H:i') }}" required="">
		</div>
	</div>

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-select-floating flex-basis-6">
			<label for="interview_type" class="text-muted fw-semibold small">Tipe Wawancara</label>
			<select name="interview_type" id="interview_type" class="form-seleect select2-single-modal" required="">
				<option value="" selected="" disabled="">Pilih satu</option>
				<option value="Online">Online</option>
				<option value="Offline">Offline</option>
			</select>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" name="interview_location" id="interview_location" class="form-control" autocomplete="off" placeholder="Lokasi Wawancara" required="">
			<label for="interview_location" class="text-muted fw-semibold small">Lokasi Wawancara</label>
		</div>
	</div>

    <div class="form-group mb-2">
	    <span class="text-muted fw-semibold small">Catatan (Tambahan)</span>
		<textarea name="description" id="description_on_modal" cols="30" rows="10" class="editor-on-modal"></textarea>
	</div>

	<div class="d-flex flex-wrap gap-2">
		<div class="form-floating flex-basis-6">
			<input type="text" class="form-control" autocomplete="off" id="person_in_charge_on_modal" name="person_in_charge" placeholder="Contact Person (Nama)" required="">
			<label for="person_in_charge_on_modal" class="text-muted fw-semibold small">Contact Person (Nama)</label>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" class="form-control" oninput="numericOnly(event);" autocomplete="off" id="phone_number_on_modal" name="phone_number" placeholder="Contact Person (No. Telepon)" required="">
			<label for="phone_number_on_modal" class="text-muted fw-semibold small">Contact Person (No. Telepon)</label>
		</div>
	</div>
	<button type="submit" class="btn btn-color d-none" id="btn-modal">Simpan</button>
</form>