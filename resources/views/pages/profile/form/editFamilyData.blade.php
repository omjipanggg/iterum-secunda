<form action="{{ route('profile.updateFamilyData', auth()->user()->profile->id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('POST')
	<input type="hidden" value="{{ auth()->user()->profile->id }}" name="profile_id">
	<div class="row g-2">
		<div class="col-12">
			<label for="close_relation_id" class="small fw-semibold">Status hubungan</label>
			<select name="close_relation_id" id="close_relation_id" required="" class="form-select select2-single-server-modal" data-bs-table="close_relations"></select>
		</div>
		<div class="col-12">
			<label for="national_number" class="small fw-semibold">No. KTP</label>
			<input type="text" onkeyup="numericOnly(event);" class="form-control" name="national_number" id="national_number" autocomplete="off">
		</div>
		<div class="col-12 col-md-6">
			<label for="name" class="small fw-semibold">Nama lengkap</label>
			<input type="text" name="name" class="form-control" autocomplete="off" id="name" required="">
		</div>
		<div class="col-12 col-md-6">
			<label for="phone_number" class="small fw-semibold">No. Telepon</label>
			<input type="text" onkeyup="numericOnly(event);" class="form-control" name="phone_number" id="phone_number" autocomplete="off">
		</div>
		<div class="col-12 col-md-7">
			<label for="place_of_birth" class="small fw-semibold">Tempat lahir</label>
			<input type="text" class="form-control" name="place_of_birth" id="place_of_birth" autocomplete="off">
		</div>
		<div class="col-12 col-md-5">
			<label for="date_of_birth" class="small fw-semibold">Tanggal lahir</label>
			<input type="date" class="form-control" name="date_of_birth" id="date_of_birth" autocomplete="off">
		</div>
		<div class="col-12 col-md-4">
			<label for="education_id" class="small fw-semibold">Pendidikan terakhir</label>
			<select name="education_id" id="education_id" required="" class="form-select select2-single-server-modal" data-bs-table="education"></select>
		</div>
		<div class="col-12 col-lg-8">
			<label for="occupation" class="small fw-semibold">Pekerjaan</label>
			<input type="text" class="form-control" name="occupation" id="occupation" autocomplete="off">
		</div>
	</div>
	<button type="submit" class="btn btn-color px-3 d-none" id="btn-modal">Simpan</button>
</form>