@extends('layouts.panel')
@section('title', 'Master')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="mb-4">
				<div class="card">
					<div class="card-body">
						<h3>Dashboard</h3>
						{{ Breadcrumbs::render('master.index') }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row g-lg-3">
		<div class="col-md-4">
			<div class="card mb-3">
				<div class="card-header text-bg-color">
					<i class="bi bi-database-lock me-2"></i>
					@yield('title')&mdash;Kirim Tautan Masuk
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
								<button class="btn btn-color rounded-0" type="submit" id="button-send">
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
					<i class="bi bi-database-lock me-2"></i>
					@yield('title')&mdash;Konfigurasi Tabel
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
</div>
@endsection