@extends('layouts.panel')
@section('title', 'Lowongan Kerja: Sunting')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('vacancy.edit', $vacancy) }}
                </div>
            </div>
		</div>
	</div>

	<div class="row">
		<div class="col">
		<form action="{{ route('vacancy.update', $vacancy->id) }}" method="POST" enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<div class="row g-3">
				<div class="col-md-12 col-lg-9">
					<div class="card">
						<div class="card-header text-bg-color">
							<div class="d-flex gap-2 flex-wrap align-items-center justify-content-between">
								<div class="group">
									<i class="bi bi-newspaper me-2"></i>
									@yield('title')
								</div>
								{{ $vacancy->project->project_number }}
							</div>
						</div>
						<div class="card-body">
							<div class="d-flex flex-wrap gap-2 mb-2">
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Jabatan/Posisi" name="name" autocomplete="off" id="name" required="" value="{{ $vacancy->name }}">
									<label for="name" class="fw-semibold small">Jabatan/Posisi</label>
								</div>
								<div class="flex-basis-6 form-select-floating">
									<label for="vacancy_type_id" class="fw-semibold small">Tipe Pekerjaan</label>
	                            	<select name="vacancy_type_id" id="vacancy_type_id" class="form-select select2-single" required="">
	                            		@foreach ($types as $type)
	                            			<option value="{{ $type->id }}" @if ($type->id === $vacancy->vacancy_type_id) selected="" @endif>{{ $type->name }}</option>
	                            		@endforeach
	                            	</select>
								</div>
							</div>

							<div class="d-flex flex-wrap gap-2 mb-2">
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Kota penempatan" name="placement" autocomplete="off" id="placement" required="" value="{{ $vacancy->placement }}">
									<label for="placement" class="fw-semibold small">Kota penempatan</label>
								</div>
								<div class="flex-basis-6 form-floating">
									<input type="text" class="form-control" placeholder="Kebutuhan personel" name="quantity" autocomplete="off" id="quantity" oninput="numericOnly(event);" required="" value="{{ $vacancy->quantity }}">
									<label for="quantity" class="fw-semibold small">Kebutuhan personel</label>
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
								<select name="skills[]" class="form-select select2-multiple" multiple="" id="skills">
									@foreach ($skills as $skill)
										@php($selected = false)
										@forelse ($vacancy->skills as $each)
											@if ($skill->id === $each->id)
												@php($selected = true)
											@endif
											@empty
										@endforelse
										<option value="{{ $skill->id }}" @if ($selected) selected="" @endif>{{ $skill->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group form-partner mb-2">
								<div class="d-flex flex-wrap gap-2 mb-1">
									{{-- <div class="flex-basis-6 form-floating order-2 order-lg-1"> --}}
										{{-- <input type="text" name="partner_name" class="form-control" autocomplete="off" id="partner_name" placeholder="Nama Mitra"> --}}
										{{-- <label for="partner_name" class="fw-semibold small">Nama Mitra</label> --}}
									{{-- </div> --}}
									<div class="form-select-floating flex-basis-6 order-2 order-lg-1">
										<select name="partner_id" id="partner_id" class="form-select select2-multiple" required="">
											@foreach ($partners as $partner)
												<option value="{{ $partner->id }}" @if ($partner->id === $vacancy->project->partner->id) selected="" @endif>{{ $partner->name }}</option>
											@endforeach
										</select>
										<label for="partner_id" class="fw-semibold small">Nama Mitra</label>
									</div>
									{{--
									<div class="flex-basis-6 form-floating order-1 order-lg-2">
										<input type="text" class="form-control" autocomplete="off" id="project_id" name="project_id" placeholder="ID Project">
										<label for="project_id" class="fw-semibold small">ID Project</label>
									</div>
									--}}
									<div class="form-select-floating flex-basis-6 order-1 order-lg-2">
										<label for="project_id" class="fw-semibold small">ID Project</label>
										<select name="project_id" id="project_id" class="form-select select2-multiple">
											@foreach ($projects as $project)
												<option value="{{ $project->id }}" @if ($project->id === $vacancy->project->id) selected="" @endif>{{ $project->project_number }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" value="1" name="hidden_partner" id="hidden_partner" @if ($vacancy->hidden_partner) checked="" @endif>
									<label class="form-check-label fw-semibold small" for="hidden_partner">Sembunyikan Mitra?</label>
								</div>
							</div>

							<div class="form-group form-salary">
								<div class="d-flex flex-wrap gap-2 mb-1">
									<div class="flex-basis-6 form-floating">
										<input type="text" class="form-control form-money" autocomplete="off" placeholder="Gaji (batas-bawah)" oninput="typingMoney(event);" id="min_limit_temp" oninput="putMoneyHolder(event, '#min_limit')" required="" value="{{ $vacancy->min_limit }}">
										<label for="min_limit_temp" class="fw-semibold small">Gaji (batas-bawah)</label>
										<input type="hidden" name="min_limit" id="min_limit" value="{{ $vacancy->min_limit }}">
									</div>
									<div class="flex-basis-6 form-floating">
										<input type="text" class="form-control form-money" autocomplete="off" placeholder="Gaji (batas-atas)" oninput="typingMoney(event);" id="max_limit_temp" oninput="putMoneyHolder(event, '#max_limit')" required="" value="{{ $vacancy->max_limit }}">
										<label for="max_limit_temp" class="fw-semibold small">Gaji (batas-atas)</label>
										<input type="hidden" name="max_limit" id="max_limit" value="{{ $vacancy->max_limit }}">
									</div>
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" value="1" name="hidden_salary" id="hidden_salary" @if ($vacancy->hidden_salary) checked="" @endif>
									<label class="form-check-label fw-semibold small" for="hidden_salary">Sembunyikan Gaji?</label>
								</div>
							</div>

							<div class="form-group mb-2">
								<label for="qualification" class="fw-semibold small mb-1">Kualifikasi</label>
								<textarea name="qualification" id="qualification" cols="30" rows="10" class="form-control editor">
									{{ $vacancy->qualification }}
								</textarea>
							</div>

							<div class="form-group mb-2">
								<label for="description" class="fw-semibold small mb-1">Deskripsi Tugas</label>
								<textarea name="description" id="description" cols="30" rows="10" class="form-control editor">
									{{ $vacancy->description }}
								</textarea>
							</div>

							<div class="form-group form-header-number">
								<a href="{{ route('server.showImageOnModal', 'contract_header_number.webp') }}" class="dotted small d-inline-block fw-semibold" onclick="showImageOnModal(event);">
									<i class="bi bi-info-circle me-1"></i>
									Apa itu Nomor KOP PKWT?
								</a>
								<div class="flex-basis-6 form-floating order-1 order-lg-2">
									<input type="text" class="form-control" id="header_number" name="header_number" autocomplete="off" placeholder="Nomor KOP PKWT" value="{{ $vacancy->header_number }}" required="">
									<label for="header_number">Nomor KOP PKWT</label>
								</div>
							</div>
						</div>
						<div class="card-footer text-bg-brighter-color">
							<i class="bi bi-info-circle me-2"></i>
							Mohon isikan semua kolom (*/) yang tersedia.
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
										@php($checked=false)
										@forelse ($vacancy->education as $each)
											@if ($edu->id === $each->id)
												@php($checked=true)
											@endif
											@empty
										@endforelse
                        			 	<li><div class="form-check">
                        					<input type="checkbox" class="form-check-input" name="education[]" @if ($checked) checked="" @endif value="{{ $edu->id }}" id="education-{{ $edu->id }}">
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
	                            		@php($checked=false)
	                            		@forelse($vacancy->categories as $each)
		                            		@if ($category->id === $each->id)
			                            		@php($checked=true)
		                            		@endif
	                            		@empty
	                            		@endforelse
                            		<div class="form-check">
	                            		<input type="checkbox" @if ($checked) checked="" @endif class="form-check-input" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
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
                                		{{--
                                		@foreach ($regions as $region)
                                			@php($selected=false)
                                			@foreach ($vacancy->regions as $selectedRegion)
                                			@if ($region->id === $selectedRegion->id)
                                			@php($selected=true)
                                			@endif
                                			@endforeach
                                			<option value="{{ $region->id }}" @if ($selected) selected="" @endif>[{{ $region->code }}] {{ $region->name }}</option>
                                		@endforeach
                                		--}}
                                		<option value="" selected="" disabled="">Pilih satu</option>
                                		@foreach ($regions as $region)
                                			<option value="{{ $region->id }}" @if ($region->id === $vacancy->region_id) selected="" @endif>[{{ $region->code }}] {{ $region->name }}</option>
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
                                    	<input type="date" name="opening_date" id="opening_date" class="form-control" required="" value="{{ to_form_date($vacancy->opening_date) }}">
                                    </div>
                                    <div class="form-date-floating mb-2">
                                    	<span for="closing_date" class="fw-semibold small">Tgl. Ditutup Lowongan</span>
                                    	<input type="date" name="closing_date" id="closing_date" class="form-control" required="" value="{{ to_form_date($vacancy->closing_date) }}">
                                    </div>
                                    <select name="active" id="active" class="form-select select2-single mb-2">
                                        <option value="1" @if ($vacancy->active) selected="" @endif>Publish now</option>
                                        <option value="0" @if (!$vacancy->active) selected="" @endif>Save as draft</option>
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