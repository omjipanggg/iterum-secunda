<div class="tab-pane fade @if (session('tab') == 'personal' || session()->missing('tab')) show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
	<div class="card">
		<form action="{{ route('profile.updatePersonalData', auth()->user()->profile->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('POST')
			<div class="card-header text-bg-brighter-color">
				<div class="d-flex flex-wrap align-items-center justify-content-between">
					<div class="wrap">
						<i class="bi bi-person-fill me-2"></i>
						Pribadi
					</div>
					<button type="submit" class="btn btn-color px-3">
						Simpan
						<i class="bi bi-send ms-1"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row g-2">
					{{-- ROW --}}
					<div class="col-12 col-md-12 col-lg-6">
						<div class="form-group">
							<label for="email" class="small fw-semibold">Alamat email</label>
							<input type="email" class="form-control disabled" disabled="" name="primary_email" autocomplete="off" id="email" value="{{ Str::lower(auth()->user()->email) }}">
						</div>
					</div>
					<div class="col-12 col-md-12 col-lg-6">
						<div class="form-group">
							<label for="name" class="small fw-semibold">Nama lengkap</label>
							<input type="text" required="" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" id="name" value="{{ old('name') ?? Str::headline(auth()->user()->name) }}">
						</div>
						@error('name')
						<span class="badge text-bg-danger">Kolom nama wajib diisi</span>
						@enderror
					</div>
					<div class="col-12 col-md-12 col-lg-7">
						<div class="form-group">
							<label for="gender" class="small fw-semibold">Jenis kelamin</label>
							<select name="gender_id" id="gender" class="form-select select2-single @error('gender_id') is-invalid @enderror">
								<option value="" disabled="" selected="">Pilih satu</option>
								@foreach ($genders as $gender)
									<option value="{{ $gender->id }}" @if(old('gender_id') == $gender->id || auth()->user()->profile->gender_id == $gender->id) selected="" @endif>{{ $gender->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-12 col-md-12 col-lg-5">
						<div class="form-group">
							<label for="phone_number" class="small fw-semibold">No. Telepon</label>
							<input type="text" onkeyup="numericOnly(event);" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" autocomplete="off" value="{{ auth()->user()->profile->phone_number ?? '' }}">
						</div>
						@error('phone_number')
						<span class="badge text-bg-danger">{{ $message }}</span>
						@enderror
					</div>

					{{-- ROW --}}
					<div class="col-12 col-lg-3 col-md-6">
						<div class="form-group">
							<label for="national_number" class="small fw-semibold">No. KTP</label>
							<input type="text" onkeyup="numericOnly(event);" autocomplete="off" class="form-control @error('national_number') is-invalid @enderror" name="national_number" id="national_number" value="{{ auth()->user()->profile->national_number ?? '' }}">
						</div>
					</div>
					<div class="col-12 col-lg-3 col-md-6">
						<div class="form-group">
							<label for="family_number" class="small fw-semibold">No. KK</label>
							<input type="text" onkeyup="numericOnly(event);" autocomplete="off" class="form-control @error('family_number') is-invalid @enderror" name="family_number" id="family_number" value="{{ auth()->user()->profile->family_number ?? '' }}">
						</div>
					</div>
					<div class="col-12 col-lg-3 col-md-6">
						<div class="form-group">
							<label for="healthcare_number" class="small fw-semibold">No. BPJS</label>
							<input type="text" onkeyup="numericOnly(event);" autocomplete="off" class="form-control @error('healthcare_number') is-invalid @enderror" name="healthcare_number" id="healthcare_number" value="{{ auth()->user()->profile->healthcare_number ?? '' }}">
						</div>
					</div>
					<div class="col-12 col-lg-3 col-md-6">
						<div class="form-group">
							<label for="tax_number" class="small fw-semibold">No. NPWP</label>
							<input type="text" onkeyup="numericOnly(event);" autocomplete="off" class="form-control @error('tax_number') is-invalid @enderror" name="tax_number" id="tax_number" value="{{ auth()->user()->profile->tax_number ?? '' }}">
						</div>
					</div>

					{{-- ROW --}}
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="birth_place" class="small fw-semibold">Tempat lahir</label>
							<input type="text" class="form-control" autocomplete="off" name="place_of_birth" id="birth_place" value="{{ auth()->user()->profile->place_of_birth ?? '' }}">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="birth_date" class="small fw-semibold">Tanggal lahir</label>
							<input type="date" class="form-control" autocomplete="off" name="date_of_birth" id="birth_date" value="{{ old('date_of_birth') ?? auth()->user()->profile->date_of_birth }}">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="marital_status" class="small fw-semibold">Status perkawinan</label>
							<select name="marital_status_id" id="marital_status" class="form-select select2-single">
								<option value="" disabled="" selected="">Pilih satu</option>
								@foreach ($maritals as $marital)
									<option value="{{ $marital->id }}" @if(old('marital_status_id') == $marital->name || auth()->user()->profile->marital_status_id == $marital->id) selected="" @endif>{{ $marital->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					{{-- ROW --}}
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="city" class="small fw-semibold">Kota domisili</label>
							<select name="city_id" id="city" class="form-select select2-single @error('city_id') is-invalid @enderror">
								<option value="" disabled="" selected="">Pilih satu</option>
								@foreach ($cities as $city)
									<option value="{{ $city->id }}" @if(old('city_id') == $city->id || auth()->user()->profile->city_id == $city->id) selected="" @endif>{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
						@error('city_id')
						<span class="badge text-bg-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-12 col-md-8">
						<div class="form-group">
							<label for="address" class="small fw-semibold">Alamat domisili</label>
							<input type="text" name="current_address" class="form-control @error('current_address') is-invalid @enderror" autocomplete="off" id="address" value="{{ auth()->user()->profile->current_address ?? '' }}">
						</div>
						@error('current_address')
						<span class="badge text-bg-danger">{{ $message }}</span>
						@enderror
					</div>

					@auth
						@if (auth()->user()->hasRole(7))
						{{-- ROW --}}
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="expected_salary" class="small fw-semibold">Gaji yang diharapkan</label>
								<input type="text" onkeyup="typingMoney(event);" class="form-control @error('expected_salary') is-invalid @enderror" name="expected_salary" id="expected_salary" autocomplete="off" value="{{ money_indo_format(auth()->user()->profile->candidate->expected_salary) ?? '' }}">
							</div>
							@error('expected_salary')
							<span class="badge text-bg-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="expected_facility" class="small fw-semibold">Fasilitas yang diharapkan</label>
								<input type="text" autocomplete="off" class="form-control" name="expected_facility" id="expected_facility" value="{{ auth()->user()->profile->candidate->expected_facility ?? '' }}">
							</div>
						</div>

						{{-- ROW --}}
						<div class="col-12">
							<label for="motivation" class="small fw-semibold">Motivasi kerja</label>
							<textarea name="motivation" id="motivation" cols="30" rows="10" class="form-control editor">
								{{ auth()->user()->profile->candidate->motivation }}
							</textarea>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="ready_to_work" class="small fw-semibold">Ketersediaan</label>
								<select name="ready_to_work" id="ready_to_work" class="form-select select2-single">
									<option value="" selected="" disabled="">Pilih satu</option>
									@foreach ($avails as $avail)
										<option value="{{ $avail }}" @if(old('ready_to_work') == $avail || auth()->user()->profile->candidate->ready_to_work == $avail) selected="" @endif >{{ $avail }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							@empty(auth()->user()->profile->candidate->resume)
							<label for="resume" class="small fw-semibold">Unggah CV Anda</label>
							<input type="file" class="form-control @error('resume') is-invalid @enderror" name="resume" id="resume" accept="image/*, application/pdf, application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12">
							<div class="d-flex align-items-center justify-content-between flex-wrap">
							<small class="small form-text">Maksimal ukuran berkas yang diunggah adalah 4MB</small>
							@error('resume')
							<span class="badge text-bg-danger">{{ $message }}</span>
							@enderror
							</div>
							@else
							<small class="small m-0"><span class="fw-semibold">Berkas: </span><a href="{{ route('home.downloadResume', auth()->user()->profile->candidate->resume) }}" target="_blank" class="dotted">CV_{{ Str::upper(Str::snake(auth()->user()->name)) . '_' . date('Y') }}<i class="bi bi-folder2-open ms-1"></i></a></small>
							<input type="hidden" name="resume" value="{{ auth()->user()->profile->candidate->resume }}">
							@endempty
						</div>
						@endif
					@endauth

					{{-- ROW --}}
					{{--
					<div class="col-12 col-lg-6">
						<button type="submit" class="btn btn-color px-3 rounded-0">
							Simpan
							<i class="bi bi-send ms-1"></i>
						</button>
					</div>
					--}}
				</div>
			</div>
			<div class="card-footer text-bg-brighter-color">
				<i class="bi bi-info-circle me-2"></i>
				Mohon pastikan bahwa data yang Anda kirimkan sudah benar dan sesuai.
			</div>
		</form>
	</div>
</div>