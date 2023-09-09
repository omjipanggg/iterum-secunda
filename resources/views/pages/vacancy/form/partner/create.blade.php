<form action="{{ route('vacancy.storePartner') }}" method="GET" data-bs-target="#partner_id" id="formAppendToSelect2" enctype="multipart/form-data">
	@method('GET')
	@csrf

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-floating flex-fill">
			<input type="text" name="name" placeholder="Nama" class="form-control" autocomplete="off" id="partner_name" required="">
			<label for="partner_name" class="fw-semibold small">Nama</label>
		</div>

		<div class="form-select-floating flex-fill">
	    	<select name="region_id" id="region_id" class="form-select select2-single-modal" required="">
	    		<option value="" selected="" disabled="">[00] Kosong</option>
	    		@foreach ($regions as $region)
	    			<option value="{{ $region->id }}">[{{ $region->code }}] {{ $region->name }}</option>
	    		@endforeach
	    	</select>
			<label for="region_id" class="fw-semibold small">Wilayah</label>
		</div>
	</div>

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-floating flex-basis-6">
			<input type="text" class="form-control" required="" autocomplete="off" id="address" name="address" placeholder="Alamat">
			<label for="address" class="fw-semibold small">Alamat</label>
		</div>
		<div class="form-select-floating flex-basis-6">
			<select name="city_id" id="city_id" class="form-select select2-single-server-modal" data-bs-table="cities" required=""></select>
			<label for="city_id" class="fw-semibold small">Kota</label>
		</div>
	</div>

	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-floating flex-fill">
			<input type="text" oninput="numericOnly(event);" class="form-control" name="established_year" id="established_year" autocomplete="off" placeholder="Tahun Berdiri">
			<label for="established_year" class="fw-semibold small">Tahun Berdiri</label>
		</div>
		<div class="form-select-floating flex-fill">
			<select name="total_employees" class="form-select select2-single-modal" id="total_employees">
				<option value="" selected="" disabled="">Pilih satu</option>
				<option value="0 - 51">0 - 51 Karyawan</option>
				<option value="52 - 97">52 - 97 Karyawan</option>
				<option value="98 - 204">98 - 204 Karyawan</option>
				<option value="205 - 473">205 - 473 Karyawan</option>
				<option value="474 - 1023">474 - 1023 Karyawan</option>
				<option value="> 1024">> 1024 Karyawan</option>
			</select>
			<label for="total_employees" class="fw-semibold small">Total Karyawan</label>
		</div>
		<div class="form-floating flex-fill">
			<input type="text" name="website" placeholder="Situs" class="form-control" autocomplete="off" id="website">
			<label for="website" class="fw-semibold small">Situs</label>
		</div>
	</div>

	<div class="form-group mb-2">
		<label for="description" class="fw-semibold small mb-1 d-inline-block">Deskripsi</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control editor-on-modal"></textarea>
	</div>

	<div class="d-flex flex-wrap gap-2 mt-2">
		<div class="form-floating flex-basis-6">
			<input type="text" name="person_in_charge" class="form-control" id="person_in_charge" autocomplete="off" placeholder="PIC">
			<label for="person_in_charge" class="fw-semibold small">PIC</label>
		</div>
		<div class="form-floating flex-basis-6">
			<input type="text" name="phone_number" class="form-control" id="phone_number" autocomplete="off" placeholder="Nomor Telepon">
			<label for="phone_number" class="fw-semibold small">Nomor Telepon</label>
		</div>
	</div>

	{{--
	<div class="form-group w-100">
		<label for="picture" class="mb-1 fw-semibold small d-inline-block">Gambar</label>
		<input type="file" class="form-control w-100" id="picture" name="picture" accept="image/*">
	</div>
	--}}

	<button type="submit" class="btn btn-color d-none" id="btn-modal">Simpan</button>
</form>