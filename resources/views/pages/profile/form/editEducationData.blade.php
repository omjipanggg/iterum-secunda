<form action="{{ route('profile.updateEducationData', auth()->user()->profile->id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('POST')
	<div class="d-flex mb-2 gap-2 flex-wrap">
		<div class="flex-fill">
			<div class="form-group">
			<label for="higher_education_id" class="small fw-semibold">Nama instansi</label>
			<select name="higher_education_id" id="higher_education_id" required="" class="form-select select2-multiple-server-modal" data-bs-table="higher_educations"></select>
			</div>
		</div>
		<div class="flex-fill">
			<div class="form-group">
			<label for="edu_city" class="small fw-semibold">Kota</label>
			<select name="city_id" id="edu_city" required="" class="form-select select2-single-server-modal" data-bs-table="cities"></select>
			</div>
		</div>
	</div>
	<div class="d-flex gap-2 mb-2 flex-wrap">
		<div class="flex-fill w-24">
			<div class="form-group">
				<label for="education_id" class="small fw-semibold">Jenjang terakhir</label>
				<select name="education_id" id="education_id" class="form-select select2-single-server-modal" required="" data-bs-table="education"></select>
			</div>
		</div>
		<div class="flex-fill">
			<div class="form-group">
				<label for="education_fields" class="small fw-semibold">Bidang keilmuan</label>
				<select name="education_field_id" id="education_fields" class="form-select select2-multiple-server-modal" required="" data-bs-table="education_fields"></select>
			</div>
		</div>
	</div>
	<div class="d-flex gap-2 mb-2 flex-wrap">
		<div class="flex-fill">
			<div class="form-group">
				<label for="graduate" class="small fw-semibold">Tahun lulus</label>
				<input type="text" class="form-control" onkeyup="numericOnly(event);" maxlength="4" autocomplete="off" required="" id="graduate" name="graduation_year">
			</div>
		</div>
		<div class="flex-fill">
			<div class="form-group">
				<label for="cgpa" class="small fw-semibold">IPK/Nilai akhir</label>
				<input id="cgpa" name="cgpa" type="number" step="0.01" min="0" class="form-control" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="certificate" class="small fw-semibold">Unggah Ijazah</label>
		<input type="file" class="form-control" id="certificate" name="certificate">
		<small class="small form-text">Maksimal ukuran berkas yang diunggah adalah 4MB</small>
	</div>
	<button type="submit" class="btn btn-color d-none" id="btn-modal">Simpan<i class="bi bi-send ms-2"></i></button>
</form>