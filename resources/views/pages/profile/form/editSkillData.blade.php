<form action="{{ route('profile.updateSkillData', auth()->user()->profile->id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('POST')
	<input type="hidden" name="profile_id" value="{{ auth()->user()->profile->id }}">
	<div class="row g-2">
		<div class="col">
			<div class="form-select-floating">
				<label for="skill_id">Nama keahlian</label>
				<select name="skill_id" id="skill_id" required="" class="form-select select2-multiple-server-modal" data-bs-table="skills"></select>
			</div>
		</div>
		<div class="col">
			<div class="form-select-floating">
				<label for="rate">Tingkat penguasaan</label>
				<select name="rate" id="rate" required="" class="form-select select2-single-modal">
					<option value="" selected="" disabled="">Pilih satu</option>
					<option value="1">Pemula ★</option>
					<option value="2">Lanjutan ★★</option>
					<option value="3">Kompeten ★★★</option>
					<option value="4">Profesional ★★★★</option>
					<option value="5">Ahli ★★★★★</option>
				</select>
			</div>
		</div>
		<div class="col-12">
			<div class="border py-2 px-12">
				<label for="certificate" class="small fw-semibold mb-1 form-text">Unggah Sertifikat (Opsional)</label>
				<input type="file" name="certificate" id="certificate" class="form-control" accept="application/pdf, image/*">
				<span class="small form-text">Batas maksimal berkas yang diunggah adalah 2MB</span>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-color px-3 d-none" id="btn-modal">Simpan</button>
</form>