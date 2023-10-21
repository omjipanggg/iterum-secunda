<div class="container-fluid p-0">
	<div class="row g-3 p-0">
		<div class="col-sm-2">
			<div class="d-flex flex-wrap flex-column align-items-center justify-content-center">
				<img src="{{ asset('storage/profiles/avatars/' . $profile->picture) }}" alt="{{ $profile->picture }}" class="img-fluid">
				<a href="{{ route('home.download', [json_encode(['profiles', 'resumes']), $profile->candidate->resume]) }}" class="btn btn-sm btn-color fw-semibold rounded-0 w-100" target="_blank">Lihat CV</a>
			</div>
		</div>
		<div class="col-sm-10">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover m-0 table-modal">
					<tr>
						<th colspan="4" class="fs-6">Data Diri</th>
					</tr>
					<tr>
						<th>No. KTP</th>
						<td>{{ $profile->national_number ?? 'BELUM DIPERBARUI' }}</td>
						<th>No. BPJS</th>
						<td>{{ $profile->healthcare_number ?? 'BELUM DIPERBARUI' }}</td>
					</tr>
					<tr>
						<th>No. KK</th>
						<td>{{ $profile->family_number ?? 'BELUM DIPERBARUI' }}</td>
						<th>No. NPWP</th>
						<td>{{ $profile->tax_number ?? 'BELUM DIPERBARUI' }}</td>
					</tr>
					<tr>
						<th>Nama Lengkap</th>
						<td colspan="3" class="fw-semibold">{{ Str::upper($profile->name) }}</td>
					</tr>
					<tr>
						<th>Kontak</th>
						<td colspan="2" class="fw-semibold">{{ Str::lower($profile->primary_email ?? '-') ?? 'BELUM DIPERBARUI' }}</td>
						<td colspan="1" class="fw-semibold text-code">{{ $profile->phone_number ?? 'BELUM DIPERBARUI' }}</td>
					</tr>
					<tr>
						@php($icon='x-circle')
						@if ($profile->gender_id == 2)
							@php($icon='gender-male')
						@elseif ($profile->gender_id == 7)
							@php($icon='gender-female')
						@else
							@php($icon='question-circle')
						@endif
						<th>Jenis Kelamin</th>
						<td colspan="2">{{ Str::upper($profile->gender->name) }}</td>
						<td colspan="1"><i class="bi bi-{{ $icon }}"></i></td>
					</tr>
					<tr>
						<th>Tempat/Tgl. Lahir</th>
						<td colspan="2">{{ Str::upper($profile->place_of_birth) }}, {{ Str::upper(date_indo_format($profile->date_of_birth)) }}</td>
						<td colspan="1">{{ calculate_age($profile->date_of_birth) }} TAHUN</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td colspan="2">{{ Str::upper($profile->current_address) }}</td>
						<td colspan="1">{{ $profile->city->name }}</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover m-0 table-modal">
					<tr>
						<th colspan="7" class="fs-6">Data Pendidikan</th>
					</tr>
					<tr>
						<th>Nama Instansi</th>
						<th>Tahun Lulus</th>
						<th>Jenjang</th>
						<th>Bidang Keilmuan</th>
						<th>Kota</th>
						<th>CGPA</th>
						<th>IJAZAH</th>
					</tr>
					@forelse ($profile->last_education as $education)
					<tr>
						<td>{{ Str::upper($education->higherEducation->name ?? '-') }}</td>
						<td>{{ $education->graduation_year }}</td>
						<td>{{ Str::upper($education->education->name ?? '-') }}</td>
						<td>{{ Str::upper($education->educationField->name ?? '-') }}</td>
						<td>{{ $education->city->name }}</td>
						<td>{{ $education->cgpa ?? '-' }}</td>
						<td><a href="{{ route('home.download', [json_encode(['profiles', 'education']), $education->certificate]) }}" class="dotted" target="_blank">Buka<i class="bi bi-folder2-open ms-1"></i></a></td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="7">BELUM DIPERBARUI</td>
					</tr>
					@endforelse
				</table>
			</div>
		</div>
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover m-0 table-modal">
					<tr>
						<th colspan="8" class="fs-6">Data Pengalaman</th>
					</tr>
					<tr>
						<th>Nama Instansi</th>
						<th>Durasi</th>
						<th>Jabatan</th>
						<th>Kota</th>
						<th>Tugas</th>
						<th colspan="2">Atasan</th>
					</tr>
					@forelse ($profile->experience as $experience)
					<tr>
						<td>{{ Str::upper($experience->company_name ?? '-') }}</td>
						<td>{{ date_indo_format($experience->starting_date) }} &mdash; <br> {{ date_indo_format($experience->ending_date) }}<br>(<strong>{{ count_duration($experience->starting_date, $experience->ending_date) }}</strong>)</td>
						<td>{{ Str::upper($experience->job_title ?? '-') }}</td>
						<td>{{ $experience->city->name }}</td>
						<td>{!! html_entity_decode($experience->job_description) !!}</td>
						<td>{{ Str::upper($experience->manager_name ?? '-') }}</td>
						<td class="text-code">{{ Str::upper($experience->manager_contact ?? '-') }}</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="7">BELUM DIPERBARUI</td>
					</tr>
					@endforelse
				</table>
			</div>
		</div>
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover m-0 table-modal">
					<tr>
						<th colspan="3" class="fs-6">Data Keahlian</th>
					</tr>
					<tr>
						<th>Nama Keahlian</th>
						<th>Penguasaan</th>
						<th>Sertifikat</th>
					</tr>
					@forelse ($profile->skills as $skill)
					<tr>
						<td>{{ $skill->name }}</td>
						<td>
							@for ($i = 0; $i < $skill->pivot->rate; $i++)
								<i class="bi bi-star-fill"></i>
							@endfor

							@for ($i = 5; $i > $skill->pivot->rate; $i--)
								<i class="bi bi-star"></i>
							@endfor
						</td>
						<td>
							@if ($skill->pivot->certificate)
							<a href="{{ route('home.download', [json_encode(['profiles', 'certificates']), $skill->pivot->certificate]) }}" class="dotted" target="_blank">Buka<i class="bi bi-folder2-open ms-1"></i></a>
							@else
							-
							@endif
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="3">BELUM DIPERBARUI</td>
					</tr>
					@endforelse
				</table>
			</div>
		</div>
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover m-0 table-modal">
					<tr>
						<th colspan="6" class="fs-6">Data Keluarga</th>
					</tr>
					<tr>
						<th>Nama</th>
						<th>Hubungan</th>
						<th>Tempat/Tgl. Lahir</th>
						<th>Jenjang</th>
						<th>Pekerjaan</th>
						<th>No. Telepon</th>
					</tr>
					@forelse ($profile->family as $family)
					<tr>
						<td>{{ Str::upper($family->name ?? '-') }}</td>
						<td>{{ Str::upper($family->relation->name ?? '-') }}</td>
						<td>{{ Str::upper($family->place_of_birth ?? '-') }}, {{ Str::upper(date_indo_format($family->date_of_birth ?? '-') ?? '-') }} (<strong>{{ calculate_age($family->date_of_birth ?? '-') }}</strong>)</td>
						<td>{{ $family->education->name }}</td>
						<td>{{ Str::upper($family->occupation ?? '-') }}</td>
						<td class="text-code">{{ $family->phone_number }}</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="6">BELUM DIPERBARUI</td>
					</tr>
					@endforelse
				</table>
			</div>
		</div>
	</div>
</div>