<form action="{{ route('vacancy.storeProject') }}" method="GET" data-bs-target="#project_id" class="formAppendToSelect2">
	@method('GET')
	@csrf

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-select-floating flex-basis-6">
	    	<select name="partner_id" id="partner_id_on_modal" class="form-select select2-single-server-modal" data-bs-table="partners" required=""></select>
			<label for="partner_id_on_modal" class="fw-semibold small">Nama Mitra</label>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" name="project_number" placeholder="ID Project" class="form-control" autocomplete="off" id="project_number" required="">
			<label for="project_number" class="fw-semibold small form-label">ID Project</label>
		</div>
		{{--
		<div class="form-floating flex-basis-4">
			<input type="text" name="name" placeholder="Nama" class="form-control" autocomplete="off" id="project_name" required="">
			<label for="project_name" class="fw-semibold small form-label">Nama</label>
		</div>
		--}}
	</div>

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-date-floating flex-basis-6">
			<span for="starting_date" class="fw-semibold small">Tgl. Awal Kerjasama</span>
			<input type="date" class="form-control" name="starting_date" id="starting_date" autocomplete="off" placeholder="{{ date_indo_format(date('Y-m-d')) }}">
		</div>
		<div class="form-date-floating flex-basis-6">
			<span for="ending_date" class="fw-semibold small">Tgl. Akhir Kerjasama</span>
			<input type="date" class="form-control" name="ending_date" id="ending_date" autocomplete="off" placeholder="{{ date_indo_format(date('Y-m-d', strtotime('+1 year'))) }}">
		</div>
	</div>

	<div class="form-group mb-2">
		<label for="description" class="fw-semibold small mb-1 d-inline-block">Deskripsi</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control editor-on-modal"></textarea>
	</div>

	{{--
	<div class="form-group mb-2">
		<label for="document" class="fw-semibold small mb-1 d-inline-block">Dokumen</label>
		<input type="file" class="form-control" autocomplete="off" name="document" id="document">
	</div>
	--}}

	<div class="d-flex flex-wrap gap-2">
		<div class="form-floating flex-basis-6">
			<input type="text" autocomplete="off" name="person_in_charge" class="form-control" placeholder="Person In Charge" id="person_in_charge">
			<label for="person_in_charge" class="fw-semibold small form-label">Person In Charge</label>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" autocomplete="off" name="phone_number" class="form-control" placeholder="No. Telepon" id="phone_number">
			<label for="phone_number" class="fw-semibold small form-label">No. Telepon</label>
		</div>
	</div>

	<button type="submit" class="btn btn-color d-none" id="btn-modal">Simpan</button>
</form>