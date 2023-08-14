@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="mb-4">
				<h3>Dashboard</h3>
				{{ Breadcrumbs::render('dashboard.index') }}
			</div>
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database me-2"></i>
					Dashboard
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 offset-md-4">
							<img src="{{ asset('img/relax.webp') }}" alt="Relax" class="img-fluid">
						</div>
						<div class="col-12">
							<p class="m-0 text-center">Hak akses Anda sedang disesuaikan.</p>
						</div>
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Laporkan kesalahan melalui <a href="#" class="underlined">tautan ini</a>.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
