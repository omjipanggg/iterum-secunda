<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
	@method('POST')
	@csrf
	<div class="d-flex flex-wrap gap-2 mb-2">
		<div class="form-floating flex-fill">
			<input type="text" class="form-control" required="" id="nameModal" name="name" autocomplete="off" placeholder="Name">
			<label for="nameModal">Name</label>
		</div>
		<div class="form-floating flex-fill">
			<input type="text" class="form-control numeric" required="" id="price" name="price" autocomplete="off" placeholder="Price">
			<label for="price">Price</label>
		</div>
	</div>

	<div class="label-select position-relative mb-2 select2-container__ngodeng">
		<select required="" name="categories[]" id="categoryModal" multiple="" class="form-select select2multipleModal" aria-label="Floating categories to be selected">
			@foreach ($categories as $element)
				<option value="{{ $element->id }}">{{ $element->name }}</option>
			@endforeach
		</select>
		<label for="categoryModal" class="text-muted">Category</label>
	</div>

	<div class="form-floating mb-2">
		<textarea class="form-control" placeholder="Description" id="descriptionModal" style="height: 96px" name="description"></textarea>
		<label for="descriptionModal">Description</label>
	</div>


	<div class="group d-flex flex-wrap flex-column align-items-start justify-content-start">
		{{-- <label for="fileInputModal" class="btn btn-color">Picture<i class="bi bi-cloud-upload ms-2"></i></label> --}}
		<label for="fileInputModal" class="pointer">
			<img src="{{ asset('img/default.png') }}" alt="Default" class="img-fluid w-99" id="imgOnModal">
		</label>
		<input type="file" name="image" class="form-control d-none" id="fileInputModal" accept=".jpg, .jpeg, .png">
		<small class="small form-text" id="fileNameModal">No file chosen</small>
	</div>

	<button type="submit" class="d-none" id="btnSubmitOnModal">Save</button>
</form>