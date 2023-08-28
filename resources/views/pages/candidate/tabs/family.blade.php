<div class="tab-pane fade @if (session('tab') == 'family') show active @endif" id="pills-family" role="tabpanel" aria-labelledby="pills-family-tab" tabindex="0">
	<div class="card">
		<div class="card-header text-bg-brighter-color">
			<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
				<div class="wrap">
					<i class="bi bi-people-fill me-2"></i>
					Keluarga
				</div>
				<a href="{{ route('profile.editFamilyData', auth()->user()->profile->id) }}" class="btn btn-color px-3" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Keluarga" data-bs-type="Tambah" onclick="event.preventDefault();" data-bs-route="{{ route('profile.editFamilyData', auth()->user()->profile->id) }}">
					Tambah
					<i class="bi bi-box-arrow-up-right ms-1"></i>
				</a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover fetch">
					<thead>
						<tr>
							<th>No</th>
							<th>Status hubungan</th>
							<th>Nama</th>
							<th>No. Telepon</th>
							<th>Tempat/Tanggal lahir</th>
						</tr>
					</thead>
					<tbody>
						@foreach (auth()->user()->profile->family as $family)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ Str::upper($family->relation->name) }}</td>
							<td>{{ Str::upper($family->name) }}</td>
							<td>{{ $family->phone_number }}</td>
							<td>{{ Str::upper($family->place_of_birth) }}, {{ Str::upper(date_indo_format($family->date_of_birth)) }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Status hubungan</th>
							<th>Nama</th>
							<th>No. Telepon</th>
							<th>Tempat/Tanggal lahir</th>
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