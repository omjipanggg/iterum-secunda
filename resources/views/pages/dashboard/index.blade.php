@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="mb-4">
				<div class="card">
					<div class="card-body">
						<h3>Dashboard</h3>
						{{ Breadcrumbs::render('dashboard.index') }}
					</div>
				</div>
			</div>
		</div>
	</div>
	@auth
	@if (auth()->user()->hasRole(1))
		<div class="row g-3">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header text-bg-color">
						<i class="bi bi-database-lock me-2"></i>
						Kirim Tautan Masuk
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card-body">
								<form action="{{ route('master.sendRegisterLink') }}" method="POST" onsubmit="loadingOnSubmit(event);">
									@csrf
									@method('POST')
									<div class="d-flex mb-1 gap-1">
										<button type="button" class="btn btn-color rounded-0" onclick="cloneRecipient(event);"><i class="bi bi-plus-square"></i></button>
										<input type="email" required="" autocomplete="off" name="recipients[]" class="form-control recipients" placeholder="Alamat email" aria-label="Alamat email" aria-describedby="button-send">
									</div>
									<div id="recipients-placeholder"></div>
									<button class="btn btn-color rounded-0 w-100" type="submit" id="button-send">
										Kirim
										<i class="bi bi-send ms-1"></i>
									</button>
								</form>
							</div>
						</div>
					</div>
					<div class="card-footer text-bg-brighter-color">
						<i class="bi bi-info-circle me-2"></i>
						Tekan tombol <code><strong>(+)</strong></code> untuk menambahkan.
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header text-bg-color">
						<div class="d-flex flex-wrap align-items-center justify-content-between">
							<div class="wrap">
								<i class="bi bi-database-lock me-2"></i>
								Konfigurasi Tabel
							</div>
							<a href="{{ route('master.generateTable') }}" onclick="plsConfirm(event);" class="dotted">
								Reset
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex flex-wrap justify-content-start align-items-center gap-1">
						@forelse (list_of_table() as $table)
							<span class="badge text-bg-color">
								<a href="{{ route('master.fetch', $table->code) }}" class="dotted">
									{{ $table->name }}
								</a>
							</span>
						@empty
						<p class="m-0">Mohon segera lakukan konfigurasi tabel.</p>
						@endforelse
						</div>
					</div>
					<div class="card-footer text-bg-brighter-color">
						<div class="d-flex align-items-center justify-content-between flex-wrap">
						<div class="wrap">
							<i class="bi bi-info-circle me-2"></i>
							{{ get_random_quotes()['quote'] }}
						</div>
						{{ get_random_quotes()['by'] }}
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	@endauth
	<div class="mt-3"></div>
	<div class="row g-3">
		<div class="col-lg-4 col-md-6">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database me-2"></i>
					Data Mitra
				</div>
				<div class="card-body position-relative">
					<div class="position-absolute icon-number">
						<p class="fw-bold">{{ $partners->count() }}</p>
					</div>
					<p class="m-0">Total: <strong>{{ $partners->count() }}</strong> Mitra</p>
					<ul class="square ps-3 m-0">
						<li>Regional:
							<ul class="ps-3 m-0">
							@foreach ($partner_regions as $region)
							<li>
								{{ $region->region->name }} ({{ Str::upper($region->region->slug) ?? 'Belum diperbarui' }}): <strong>{{ $region->total }}</strong> Mitra
							</li>
							@endforeach
							</ul>
						</li>
					</ul>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-box-arrow-up-right me-2"></i>
					<a href="#" class="dotted">Kelola Data</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database me-2"></i>
					Data Pelamar
				</div>
				<div class="card-body position-relative">
					<div class="position-absolute icon-number">
						<p class="fw-bold">{{ $candidates->count() }}</p>
					</div>
					<p class="m-0">Total: <strong>{{ $candidates->count() }}</strong> Kandidat</p>
					<ul class="square ps-3 m-0">
						<li>Jenis Kelamin:
							<ul class="ps-3 m-0">
								@foreach ($candidate_genders as $gender)
								<li>{{ $gender->profile->gender->name ?? 'Belum diperbarui' }}: <strong>{{ $gender->total }}</strong> Kandidat</li>
								@endforeach
							</ul>
						</li>
						<li>Pendidikan:
							<ul class="ps-3 m-0">
								<li>Belum diperbarui</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-box-arrow-up-right me-2"></i>
					<a href="#" class="dotted">Kelola Data</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database me-2"></i>
					Data Lowongan Kerja
				</div>
				<div class="card-body position-relative">
					<div class="position-absolute icon-number">
						<p class="fw-bold">{{ $vacancies->count() }}</p>
					</div>
					<p class="m-0">Total: <strong>{{ $vacancies->count() }}</strong> Lowongan</p>
					<ul class="square ps-3 m-0">
						<li>Status:
							<ul class="ps-3 m-0">
								@foreach ($vacancy_status as $status)
								<li>{{ ($status->active) ? 'Aktif' : 'Tidak Aktif' }}: <strong>{{ $status->total }}</strong> Lowongan</li>
								@endforeach
							</ul>
						</li>
						<li>Regional:
							<ul class="ps-3 m-0">
								@foreach ($vacancy_regions as $region)
								<li>
									{{ $region->region->name ?? 'Belum diperbarui' }}: <strong>{{ $region->total }}</strong> Lowongan
								</li>
								@endforeach
							</ul>
						</li>
					</ul>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-box-arrow-up-right me-2"></i>
					<a href="#" class="dotted">Kelola Data</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
