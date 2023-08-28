<div class="tab-pane fade @if (session('tab') == 'skill') show active @endif" id="pills-skill" role="tabpanel" aria-labelledby="pills-skill-tab" tabindex="0">
	<div class="card">
		<div class="card-header text-bg-brighter-color">
			<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
				<div class="wrap">
					<i class="bi bi-bar-chart-fill me-2"></i>
					Keahlian
				</div>
				<a href="{{ route('profile.editSkillData', auth()->user()->profile->id) }}" class="btn btn-color px-3" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Keahlian" data-bs-type="Tambah" onclick="event.preventDefault();" data-bs-route="{{ route('profile.editSkillData', auth()->user()->profile->id) }}">
					Tambah
					<i class="bi bi-box-arrow-up-right ms-1"></i>
				</a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm fetch">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama keahlian</th>
							<th>Tingkat penguasaan</th>
							<th>Sertifikat</th>
						</tr>
					</thead>
					<tbody>
						@foreach (auth()->user()->profile->skills as $skill)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ Str::upper($skill->name) }}</td>
							<td>
								@for ($i = 0; $i < $skill->pivot->rate; $i++)
									★
								@endfor
							</td>
							<td>
								@isset($skill->pivot->certificate)
								<a href="{{ route('home.download', [json_encode(['profiles', 'certificates']), $skill->pivot->certificate]) }}" class="dotted" target="_blank">Buka<i class="bi bi-folder2-open ms-1"></i></a>
								@else
								<em>null</em>
								@endisset
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Nama keahlian</th>
							<th>Tingkat penguasaan</th>
							<th>Sertifikat</th>
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
