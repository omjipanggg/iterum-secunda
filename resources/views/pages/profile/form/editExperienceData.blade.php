<form action="{{ route('profile.updateExperienceData', auth()->user()->profile->id) }}" method="POST">
	@csrf
	@method('POST')
	<div class="row gx-2 gy-1">
		<div class="col-12 col-md-12 col-lg-4">
			<label for="job_title" class="small fw-semibold">Jabatan terakhir</label>
			<input type="text" class="form-control" name="job_title" id="job_title" autocomplete="off" required="">
		</div>
		<div class="col-12 col-md-6 col-lg-4">
			<label for="company_name" class="small fw-semibold">Nama instansi</label>
			<input type="text" class="form-control" name="company_name" id="company_name" autocomplete="off" required="">
		</div>
		<div class="col-12 col-md-6 col-lg-4">
			<label for="city_id_modal" class="small fw-semibold">Kota</label>
			<select name="city_id" id="city_id_modal" class="form-select select2-single-server-modal" data-bs-table="cities" required=""></select>
		</div>
		<div class="col-12 col-md-6">
			<label for="starting_date" class="small fw-semibold">Tanggal mulai</label>
			<input type="date" class="form-control" name="starting_date" autocomplete="off" id="starting_date">
		</div>
		<div class="col-12 col-md-6">
			<label for="ending_date" class="small fw-semibold">Tanggal akhir</label>
			<input type="date" class="form-control" name="ending_date" autocomplete="off" id="ending_date">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="on" name="until_now" id="checkboxUntilNow" onchange="disableUntilNow(event);">
				<label class="form-check-label small" for="checkboxUntilNow">Masih bekerja di sini</label>
			</div>
		</div>
		<div class="col-12">
			<label for="job_description" class="small fw-semibold">Uraian tugas</label>
			<textarea name="job_description" id="job_description" cols="30" rows="10" class="form-control editor-on-modal"></textarea>
		</div>
		<div class="col-12 col-md-6">
			<label for="manager_name" class="small fw-semibold">Nama Atasan (Opsional)</label>
			<input type="text" class="form-control" id="manager_name" name="manager_name" autocomplete="off">
		</div>
		<div class="col-12 col-md-6">
			<label for="manager_contact" class="small fw-semibold">No. Telepon Atasan (Opsional)</label>
			<input type="text" class="form-control" id="manager_contact" name="manager_contact" autocomplete="off">
		</div>

	</div>
	<button class="btn btn-color px-3 d-none" type="submit" id="btn-modal">Kirim</button>
</form>