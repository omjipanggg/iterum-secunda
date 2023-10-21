<form action="{{ route('recruitment.index') }}" method="GET">
	<div class="form-select-floating mb-2">
		<select name="gender[]" id="genders" class="form-select select2-single-server-modal" multiple="" data-bs-table="genders"></select>
		<label for="genders" class="fw-semibold small">Jenis Kelamin</label>
	</div>
	<div class="form-select-floating mb-2">
		<select name="city[]" id="cities" class="form-select select2-single-modal" multiple="">
			@foreach ($cities as $city)
				<option value="{{ $city->id }}">{{ $city->name }}</option>
			@endforeach
		</select>
		<label for="cities" class="fw-semibold small">Kota Domisili</label>
	</div>
	<div class="form-select-floating mb-2">
		<select name="education[]" id="education" class="form-select select2-single-modal" multiple="">
			@foreach ($education as $edu)
				<option value="{{ $edu->id }}">{{ $edu->name }}</option>
			@endforeach
		</select>
		<label for="education" class="fw-semibold small">Pendidikan</label>
	</div>
	<div class="d-flex gap-2 mb-2 flex-wrap">
		<div class="form-floating flex-fill">
			<input type="text" class="form-control" oninput="numericOnly(event);" placeholder="Usia (Maksimal)" autocomplete="off" name="age" id="age">
			<label for="age" class="fw-semibold small">Usia (Maksimal)</label>
		</div>
		<div class="form-floating flex-fill">
			<input type="text" class="form-control" oninput="typingMoney(event);" name="min_limit" placeholder="Gaji (Batas Bawah)" autocomplete="off" id="min_limit_label">
			<input type="hidden" id="min_limit" value="0">
			<label for="min_limit_label" class="fw-semibold small">Gaji (Batas Bawah)</label>
		</div>
		<div class="form-floating flex-fill">
			<input type="text" class="form-control" oninput="typingMoney(event);" name="max_limit" placeholder="Gaji (Batas Atas)" autocomplete="off" id="max_limit_label">
			<input type="hidden" id="max_limit" value="0">
			<label for="max_limit_label" class="fw-semibold small">Gaji (Batas Atas)</label>
		</div>
	</div>
	<div class="form-select-floating">
		<select name="ready_to_work" id="ready_to_work" class="form-select select2-single-modal" multiple="">
			@foreach ($availability as $key => $value)
				<option value="{{ $key }}">{{ $value }}</option>
			@endforeach
		</select>
		<label for="ready_to_work" class="fw-semibold small">Ketersediaan</label>
	</div>
	<button type="submit" class="d-none btn btn-color px-3" id="btn-modal">Terapkan</button>
</form>