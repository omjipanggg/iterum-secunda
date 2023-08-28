<div class="tab-pane fade @if (session('tab') == 'education') show active @endif" id="pills-education" role="tabpanel" aria-labelledby="pills-education-tab" tabindex="0">
	<div class="card">
		<div class="card-header text-bg-brighter-color">
			<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
				<div class="wrap">
					<i class="bi bi-mortarboard-fill me-2"></i>
					Pendidikan
				</div>
				<a href="{{ route('profile.editEducationData', auth()->user()->profile->id) }}" class="btn btn-color px-3" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Pendidikan" data-bs-type="Tambah" onclick="event.preventDefault();" data-bs-route="{{ route('profile.editEducationData', auth()->user()->profile->id) }}">
					Tambah
					<i class="bi bi-box-arrow-up-right ms-1"></i>
				</a>
			</div>
		</div>
		<div class="card-body">
			{{--
			<div class="form-select-floating">
				<label for="school">Nama Sekolah</label>
				<select name="school" id="school" class="select2-ajax-school form-select"></select>
			</div>
			--}}
			<div class="table-responsive">
				<table class="table table-bordered table-sm table-hover fetch">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenjang pendidikan</th>
							<th>Nama instansi</th>
							<th>Kota</th>
							<th>Bidang keilmuan</th>
							<th>Tahun lulus</th>
							<th>Nilai akhir</th>
							<th>Berkas</th>
						</tr>
					</thead>
					<tbody>
						@foreach (auth()->user()->profile->lastEducation as $element)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ Str::upper($element->education->name) ?? '' }}</td>
								<td>{{ Str::upper($element->higherEducation->name) ?? '' }}</td>
								<td>{{ Str::upper($element->city->name) ?? '' }}</td>
								<td>{{ Str::upper($element->educationField->name) ?? '' }}</td>
								<td>{{ $element->graduation_year ?? '' }}</td>
								<td>{{ $element->cgpa ?? '' }}</td>
								@empty($element->certificate)
								<td><em>null</em></td>
								@else
								<td><a href="{{ route('home.download', [json_encode(['profiles', 'certificates']), $element->certificate]) }}" class="dotted" target="_blank">Buka<i class="bi bi-folder2-open ms-1"></i></a></td>
								@endempty
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Jenjang pendidikan</th>
							<th>Nama instansi</th>
							<th>Kota</th>
							<th>Bidang keilmuan</th>
							<th>Tahun lulus</th>
							<th>Nilai akhir</th>
							<th>Berkas</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="card-footer text-bg-brighter-color">
			<i class="bi bi-info-circle me-2"></i>
			Mohon pastikan bahwa data yang Anda kirimkan sudah benar.
		</div>
	</div>
</div>
