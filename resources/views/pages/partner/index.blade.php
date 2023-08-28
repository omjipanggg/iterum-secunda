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
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<i class="bi bi-exclamation-circle me-2"></i>
						<strong>Perhatian!</strong>
						Mohon lengkapi data di bawah ini sebelum melanjutkan.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					Partner
				</div>
				<div class="card-footer">
					<i class="bi bi-info-circle me-2"></i>
					Mohon isikan seluruh data dengan benar.
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
