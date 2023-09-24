@extends('layouts.panel')
@section('title', 'Lowongan Kerja: Tambah')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('vacancy.create') }}
                </div>
            </div>
		</div>
	</div>

	<div class="row">
		<div class="col">
		<form action="{{ route('vacancy.store') }}" method="POST" enctype="multipart/form-data">
			@method('POST')
			@csrf
			<div class="row g-3">
				<div class="col-md-12 col-lg-9">
					<div class="card">
						<div class="card-header text-bg-color">
							<i class="bi bi-newspaper me-2"></i>
							@yield('title')
						</div>
						<div class="card-body">
							<div class="d-flex flex-wrap gap-2 mb-2">
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Jabatan/Posisi" name="name" autocomplete="off" id="name" required="">
									<label for="name" class="fw-semibold small">Jabatan/Posisi</label>
								</div>
								<div class="flex-basis-6 form-select-floating">
									<label for="vacancy_type_id" class="fw-semibold small">Tipe Pekerjaan</label>
	                            	<select name="vacancy_type_id" id="vacancy_type_id" class="form-select select2-single-server" data-bs-table="vacancy_types"></select>
								</div>
							</div>

							<div class="d-flex flex-wrap gap-2 mb-2">
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Kota Penempatan" name="placement" autocomplete="off" id="placement" required="">
									<label for="placement" class="fw-semibold small">Kota Penempatan</label>
								</div>
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Kebutuhan Personel" name="quantity" autocomplete="off" id="quantity" oninput="numericOnly(event);" required="">
									<label for="quantity" class="fw-semibold small">Kebutuhan Personel</label>
								</div>
							</div>
							{{--
							<div class="form-select-floating">
								<label for="education_id" class="fw-semibold small">Pendidikan</label>
								<select name="education[]" id="education_id" data-bs-table="education" class="form-select select2-single-server" multiple=""></select>
							</div>
							--}}
							<div class="form-select-floating mb-2">
								<label for="skills" class="fw-semibold small">Keahlian</label>
								<select name="skills[]" class="form-select select2-multiple-server" multiple="" id="skills" data-bs-table="skills"></select>
							</div>

							<div class="form-group form-partner mb-2">
								<div class="d-flex flex-wrap gap-2 mb-1">
									{{-- <div class="flex-basis-6 form-floating order-2 order-lg-1"> --}}
										{{-- <input type="text" name="partner_name" class="form-control" autocomplete="off" id="partner_name" placeholder="Nama Mitra"> --}}
										{{-- <label for="partner_name" class="fw-semibold small">Nama Mitra</label> --}}
									{{-- </div> --}}
									<div class="form-group flex-basis-6 order-2 order-sm-1">
									<a href="{{ route('vacancy.createPartner') }}" class="dotted small form-text d-inline-block mb-1" data-bs-route="{{ route('vacancy.createPartner') }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Mitra" data-bs-type="Tambah" onclick="event.preventDefault();"><i class="bi bi-plus-square me-2"></i>Tambahkan Mitra baru</a>
									<div class="form-select-floating">
										<select name="partner_id" id="partner_id" class="form-select select2-single-server" data-bs-table="partners" required=""></select>
										<label for="partner_id" class="fw-semibold small">Nama Mitra</label>
									</div>
									</div>
									{{--
									<div class="flex-basis-6 form-floating order-1 order-lg-2">
										<input type="text" class="form-control" autocomplete="off" id="project_id" name="project_id" placeholder="ID Project">
										<label for="project_id" class="fw-semibold small">ID Project</label>
									</div>
									--}}
									<div class="form-group flex-basis-6 order-1 order-sm-2">
									<a href="{{ route('vacancy.createProject') }}" class="dotted small form-text d-inline-block mb-1" data-bs-route="{{ route('vacancy.createProject') }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Project" data-bs-type="Tambah" onclick="event.preventDefault();"><i class="bi bi-plus-square me-2"></i>Tambahkan ID Project baru</a>
									<div class="form-select-floating">
										<label for="project_id" class="fw-semibold small">ID Project</label>
										<select name="project_id" id="project_id" class="form-select select2-single">
											<option value="" selected="" disabled="">Pilih satu</option>
											@foreach ($projects as $project)
												<option value="{{ $project->id }}">{{ $project->project_number }}</option>
											@endforeach
										</select>
									</div>
									</div>
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" value="1" name="hidden_partner" id="hidden_partner">
									<label class="form-check-label fw-semibold small" for="hidden_partner">Sembunyikan Mitra?</label>
								</div>
							</div>

							<div class="form-group form-salary">
								<div class="d-flex flex-wrap gap-2 mb-1">
									<div class="flex-basis-6 form-floating">
										<input type="text" class="form-control" autocomplete="off" placeholder="Gaji (batas-bawah)" oninput="typingMoney(event);" id="min_limit_temp" onkeyup="putMoneyHolder(event, '#min_limit')" required="">
										<label for="min_limit_temp" class="fw-semibold small">Gaji (batas-bawah)</label>
										<input type="hidden" name="min_limit" id="min_limit">
									</div>
									<div class="flex-basis-6 form-floating">
										<input type="text" class="form-control" autocomplete="off" placeholder="Gaji (batas-atas)" oninput="typingMoney(event);" id="max_limit_temp" onkeyup="putMoneyHolder(event, '#max_limit')" required="">
										<label for="max_limit_temp" class="fw-semibold small">Gaji (batas-atas)</label>
										<input type="hidden" name="max_limit" id="max_limit">
									</div>
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" value="1" name="hidden_salary" id="hidden_salary">
									<label class="form-check-label fw-semibold small" for="hidden_salary">Sembunyikan Gaji?</label>
								</div>
							</div>

							<div class="form-group mb-2">
								<label for="qualification" class="fw-semibold small mb-1">Kualifikasi</label>
								<textarea name="qualification" id="qualification" cols="30" rows="10" class="form-control editor"></textarea>
							</div>

							<div class="form-group mb-2">
								<label for="description" class="fw-semibold small mb-1">Deskripsi Tugas</label>
								<textarea name="description" id="description" cols="30" rows="10" class="form-control editor"></textarea>
							</div>

							<div class="form-group form-header-number">
								<a href="{{ route('server.showImageOnModal', 'contract_header_number.webp') }}" class="dotted small mb-1 form-text d-inline-block" onclick="showImageOnModal(event);">
									<i class="bi bi-info-circle me-1"></i>
									Apa itu Nomor KOP PKWT?
								</a>
								<div class="flex-basis-6 form-floating order-1 order-lg-2">
									<input type="text" class="form-control" id="header_number" name="header_number" autocomplete="off" placeholder="Nomor KOP PKWT">
									<label for="header_number">Nomor KOP PKWT</label>
								</div>
							</div>
						</div>
						<div class="card-footer text-bg-brighter-color">
							<i class="bi bi-info-circle me-2"></i>
							Mohon isikan semua kolom (*/) yang tersedia.
						</div>
					</div>

					<div class="mb-3"></div>

					<div class="card">
						<div class="card-header text-bg-color">
                            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
	                            <div class="group">
	                                <i class="bi bi-file-earmark-ruled me-2"></i>
	                                Soal Tes Mandiri
	                            </div>
	                            <span class="badge text-bg-brighter-color">opsional</span>
                            </div>

						</div>
						<div class="card-body">
							<input type="hidden" value="{{ strtotime('now') }}" name="unique_number">
							<div class="d-flex my-1 gap-1 question flex-wrap" id="question-block-1">
								<div class="form-group flex-fill d-flex  gap-1">
									<button type="button" class="btn btn-color rounded-0 px-4 b-hide" onclick="cloneQuestion(event);"><i class="bi bi-plus-square"></i></button>
									<div class="form-select-floating flex-fill question-container" id="question-1">
										<select name="test_category[]" class="form-select select2-single-server select2-test-categories" data-bs-table="test_categories" id="select2-question-1"></select>
										<label for="select2-question-1" class="fw-semibold small">Kategori Soal Tes</label>
									</div>
								</div>
								<div class="form-group flex-fill">
									<div class="form-floating">
										<input type="text" name="test_name[]" id="test-name-1" placeholder="Nama Tes" class="form-control test-name" autocomplete="off">
										<label for="test-name-1" class="fw-semibold small">Nama Tes</label>
									</div>
								</div>
								<div class="form-group flex-fill">
									<div class="form-floating">
										<input type="text" class="form-control test-limitation" autocomplete="off" oninput="numericOnly(event);" name="test_limitation[]" id="test-limitation-1" placeholder="Butir soal tes">
										<label for="test-limitation-1" class="fw-semibold small">Butir Soal Tes</label>
									</div>
								</div>
								<div class="form-group flex-fill">
									<div class="form-floating">
										<input type="text" class="form-control test-duration" autocomplete="off" oninput="numericOnly(event);" name="test_duration[]" id="test-duration-1" placeholder="Durasi pengerjaan (menit)" min="1">
										<label for="test-duration-1" class="fw-semibold small">Durasi Pengerjaan (menit)</label>
									</div>
								</div>
							</div>
							<div id="question-holder"></div>
						</div>
						<div class="card-footer text-bg-brighter-color">
							<i class="bi bi-info-circle me-2"></i>
							Untuk menambahkan materi soal, silakan menuju <a href="#" class="underlined fw-semibold">tautan ini</a>.
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-3">
					<div class="row g-3">
                        <div class="col-md-12 order-lg-3">
                        	<div class="card">
                        		<div class="card-header text-bg-color">
                        			<i class="bi bi-mortarboard me-2"></i>
                        			Pendidikan
                        		</div>
                        		<div class="card-body">
                        			<ul class="tri p-0 m-0">
                        			@foreach ($education as $edu)
                        			 	<li><div class="form-check">
                        					<input type="checkbox" class="form-check-input" name="education[]" value="{{ $edu->id }}" id="education-{{ $edu->id }}">
                        					<label for="education-{{ $edu->id }}" class="form-check-label">{{ $edu->name }}</label>
                        				</div></li>
                        			@endforeach
                        			</ul>
                        		</div>
                        	</div>
                        </div>

                        <div class="col-md-12 order-lg-4">
                            <div class="card">
                                <div class="card-header text-bg-color">
                                	<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                		<div class="form-group">
		                                    <i class="bi bi-tags me-2"></i>
		                                    Kategori
                                		</div>
                                        <a href="{{ route('vacancy.createCategory') }}" data-bs-route="{{ route('vacancy.createCategory') }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Kategori" data-bs-type="Tambah" onclick="event.preventDefault()">
                                        	<i class="bi bi-plus-square"></i>
                                        </a>
                                	</div>
                                </div>
                                <div class="card-body" id="category-holder">
                            		@forelse($categories as $category)
                            		<div class="form-check">
	                            		<input type="checkbox" class="form-check-input" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
	                            		<label for="category-{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                                	</div>
                            		@empty
                            		@endforelse
                                </div>
                            </div>
                        </div>

                        {{--
                        <div class="col-md-12 order-lg-4">
                            <div class="card">
                                <div class="card-header text-bg-color">
                                    <i class="bi bi-file-earmark-text me-2"></i>
                                    Catatan
                                </div>
                                <div class="card-body">
                                	<div class="text-justify">
                                		Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque nostrum facilis quidem atque quo consequuntur doloribus suscipit deleniti quisquam quibusdam?
                                	</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 order-lg-2">
                            <div class="card">
                                <div class="card-header text-bg-color">
                                    <i class="bi bi-bookmarks me-2"></i>
                                    Tipe Pekerjaan
                                </div>
                                <div class="card-body">
                                	<select name="vacancy_type_id" id="vacancy_type_id" class="form-select select2-single-server" data-bs-table="vacancy_types"></select>
                                </div>
                            </div>
                        </div>
                        --}}

                        <div class="col-md-12 order-lg-2">
                            <div class="card">
                                <div class="card-header text-bg-color">
                                    <i class="bi bi-globe-americas me-2"></i>
                                    Wilayah
                                </div>
                                <div class="card-body">
                                	<select name="region_id" id="region_id" class="form-select select2-single" required="">
	                	{{-- <select name="region_id[]" id="region_id" class="form-select select2-multiple" multiple="" required=""> --}}
	                					<option value="" selected="" disabled="">Pilih satu</option>
                                		@foreach ($regions as $region)
                                			<option value="{{ $region->id }}">[{{ $region->code }}] {{ $region->name }}</option>
                                		@endforeach
                                	</select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 order-lg-1">
							<div class="card">
								<div class="card-header text-bg-color">
                                    <i class="bi bi-file-earmark-check me-2"></i>
									Publikasi
								</div>
								<div class="card-body">
                                    <div class="form-date-floating mb-2">
                                    	<span for="opening_date" class="fw-semibold small">Tgl. Dibuka Lowongan</span>
                                    	<input type="date" name="opening_date" id="opening_date" class="form-control" required="" placeholder="{{ date_indo_format(date('Y-m-d')) }}">
                                    </div>
                                    <div class="form-date-floating mb-2">
                                    	<span for="closing_date" class="fw-semibold small">Tgl. Ditutup Lowongan</span>
                                    	<input type="date" name="closing_date" id="closing_date" class="form-control" required="" placeholder="{{ date_indo_format(date('Y-m-d', strtotime('+1 year'))) }}">
                                    </div>
                                    <select name="active" id="active" class="form-select select2-single mb-2">
                                        <option value="1">Publish now</option>
                                        <option value="0">Save as draft</option>
                                    </select>
								</div>
								<div class="card-footer text-bg-brighter-color">
									<button type="submit" class="btn btn-color w-100 px-3 breathing">
										Simpan
										<i class="bi bi-save ms-1"></i>
									</button>
								</div>
							</div>
                        </div>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
@endsection