@extends('layouts.panel')
@section('title', 'Generate PKWT')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('contract.index') }}
                </div>
            </div>
			<div class="card">
				<div class="card-header text-bg-color">
					<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
						<div class="group">
							<i class="bi bi-database-gear me-2"></i>
							@yield('title')
						</div>
						<a href="{{ route('contract.sendOffering') }}" onclick="triggerClick(event, '#btn-generate');" class="btn btn-outline-color btn-sm px-3">
							Generate
							<i class="bi bi-gear-wide-connected ms-1"></i>
						</a>
					</div>
				</div>
				<div class="card-body">

					@error('generated')
					<div class="alert alert-danger rounded-0" role="alert">
						<i class="bi bi-info-circle me-2"></i>
						<strong>Kesalahan!</strong>
						{{ $message }}
					</div>
					@enderror

					<form action="{{ route('contract.generate') }}" method="POST" id="formGenerate" enctype="multipart/form-data">
						@csrf
						@method('POST')
						<div id="generated-placeholder"></div>
						<div class="form-select-floating mb-2">
							<label for="department_name" class="fw-semibold small">Dept./Divisi</label>
							<select name="department_name" id="department_name" class="form-select select2-multiple-server" required="" data-bs-table="departments"></select>
						</div>
						<div class="form-group border p-2">
						<label for="template" class="fw-semibold small mb-1">Template PKWT</label>
						<input type="file" autocomplete="off" accept="application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12" class="form-control" name="template" id="template">
						</div>
						<button type="submit" class="d-none" id="btn-generate">Kirim</button>
					</form>

					<div class="table-responsive mt-3">
						<table class="table table-sm table-bordered table-hover disabled-order responsive">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center @error('generated') is-invalid @enderror">#</th>
									<th class="text-center"><i class="bi bi-pencil-square"></i></th>
									<th>Status</th>
									<th>Unduhan</th>
									<th>Lowongan Kerja</th>
									<th>Penempatan</th>
									<th>Tgl. Awal Kontrak</th>
									<th>Tgl. Akhir Kontrak</th>
									<th>Nama Pelamar</th>
									<th>THP</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($offerings as $offer)
								@php($generated=$offer->contract)
								<tr>
									<td class="text-center">{{ $loop->iteration }}</td>
									<td class="@error('generated') is-invalid @enderror">
										<div class="form-check d-flex align-items-center justify-content-center">
											<input class="form-check-input check-box-generated" type="checkbox" value="{{ $offer->id }}" id="generated-{{ $offer->id }}">
										</div>
									</td>
									<td class="px-2 text-center">
										<a href="{{ route('score.show', $offer->score->schedule->id) }}" class="dotted" target="_blank">
											<i class="bi bi-pencil-square"></i>
										</a>
									</td>
									<td>
										@if ($generated)
											<span class="badge text-bg-success rounded-0 pt-1">
												<i class="bi bi-check-circle me-1"></i>
												Generated
											</span>
										@else
											<span class="badge text-bg-dark rounded-0 pt-1">
												<i class="bi bi-skip-forward-circle me-1"></i>
												Queued
											</span>
										@endif
									</td>
									<td><strong>{{ $offer->contract->generated_count ?? 0 }}</strong> kali</td>
									<td class="pe-4">
										<a href="{{ route('vacancy.show', $offer->score->schedule->proposal->vacancy->id) }}" class="dotted fw-semibold" target="_blank">
										<em>{{ Str::upper($offer->score->schedule->proposal->vacancy->project->project_number) }}</em>
										&middot;
										{{ Str::upper($offer->score->schedule->proposal->vacancy->name) }}
										</a>
									</td>
									<td>{{ Str::upper($offer->score->placement_to_be) }}</td>
									<td>{{ date_indo_format($offer->score->starting_date) }}</td>
									<td>{{ date_indo_format($offer->score->ending_date) }}</td>
									<td>
										<a href="{{ route('profile.detail', $offer->score->schedule->proposal->candidate->profile->id) }}" data-bs-toggle="modal" data-bs-target="#modalBodyOnly" data-bs-type="{{ Str::upper($offer->score->schedule->proposal->candidate->profile->name) }}" data-bs-table="PROFILE" class="dotted fw-semibold">{{ Str::upper($offer->score->schedule->proposal->candidate->profile->name) }}</a>
									</td>
									<td>Rp{{ money_indo_format($offer->score->first_salary + $offer->score->second_salary) }},-</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center @error('generated') is-invalid @enderror">#</th>
									<th class="text-center"><i class="bi bi-pencil-square"></i></th>
									<th>Status</th>
									<th>Unduhan</th>
									<th>Lowongan Kerja</th>
									<th>Penempatan</th>
									<th>Tgl. Awal Kontrak</th>
									<th>Tgl. Akhir Kontrak</th>
									<th>Nama Pelamar</th>
									<th>THP</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Mohon berikan tanda (☑) untuk memilih kandidat.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection