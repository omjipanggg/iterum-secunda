<div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab" tabindex="0">
	<div class="card">
		<div class="card-header text-bg-brighter-color">
			<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
				<div class="wrap">
					<i class="bi bi-briefcase-fill me-2"></i>
					Pengalaman
				</div>
				<a href="{{ route('profile.editExperienceData', auth()->user()->profile->id) }}" class="btn btn-color px-3" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Pengalaman" data-bs-type="Tambah" onclick="event.preventDefault();" data-bs-route="{{ route('profile.editExperienceData', auth()->user()->profile->id) }}">
					Tambah
					<i class="bi bi-box-arrow-up-right ms-1"></i>
				</a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-sm table-hover fetch">
					<thead>
						<tr>
							<th>No</th>
							<th>Posisi</th>
							<th>Nama perusahaan</th>
							<th>Kota</th>
							<th>Tanggal mulai</th>
							<th>Tanggal akhir</th>
							<th>Deskripsi tugas</th>
						</tr>
					</thead>
					<tbody>
						@foreach (auth()->user()->profile->experience as $experience)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ Str::upper($experience->job_title)  }}</td>
							<td>{{ Str::upper($experience->company_name) }}</td>
							<td>{{ Str::upper($experience->city->name) }}</td>
							<td>{{ date_indo_format($experience->starting_date) }}</td>
							<td>{{ date_indo_format($experience->ending_date) }}</td>
							<td>{!! htmlspecialchars_decode(stripslashes($experience->job_description)) !!}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Posisi</th>
							<th>Nama perusahaan</th>
							<th>Kota</th>
							<th>Tanggal mulai</th>
							<th>Tanggal akhir</th>
							<th>Deskripsi</th>
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
