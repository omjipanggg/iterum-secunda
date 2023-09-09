<form action="{{ route('vacancy.storeCategory') }}" method="POST">
	@method('POST')
	@csrf
	<div class="form-floating">
		<input type="text" name="name" class="form-control" required="" id="category-name-on-modal" placeholder="Nama" autocomplete="off">
		<label for="category-name-on-modal" class="fw-semibold small">Nama</label>
	</div>
	<button type="submit" class="btn btn-color d-none" id="btn-modal" onclick="appendToCategories(event);">Simpan</button>
</form>