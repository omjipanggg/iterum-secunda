<div id="by-category"></div>
<section id="sort-by-category" class="bg-brighter-color py-6">
	<div class="container">
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <h2 class="section-title">
                        <a href="#by-category" class="dotted">Kategori Pekerjaan</a>
                    </h2>
                    <p class="section-subtitle text-muted">Telusuri berdasarkan kategori pekerjaan</p>
                </div>
            </div>
        </div>
		<div class="row g-3 pt-6 hr-top position-relative align-items-center">
			@foreach ($categories as $category)
			<div class="col-12 col-md-6 col-lg-3">
				<div class="card pointer py-4" onclick="window.location.href = '{{ route('category.show', $category->slug) }}';">
					<div class="card-body">
						<div class="text-center">
							<p class="text-color fs-3">
								<i class="bi bi-tags"></i>
							</p>
							<h5 class="m-0 fw-semibold text-color">{{ $category->name }}</h5>
							<p class="m-0 text-muted">{{ $category->vacancies_count }} Lowongan</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col d-flex align-items-center justify-content-center pt-5">
				<a href="{{ route('category.index') }}" class="btn btn-color btn-lg rounded-0 px-3 mt-3">
					Telusuri Kategori Lainnya
					<i class="bi bi-arrow-right ms-1"></i>
				</a>
			</div>
		</div>
	</div>
</section>