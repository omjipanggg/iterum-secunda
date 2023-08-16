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
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-database-lock me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					<div class="d-flex flex-wrap justify-content-start align-items-center gap-1">
					@forelse ($tables as $table)
						<span class="badge text-bg-color">
							<a href="{{ route('master.fetch', $table->code) }}" class="dotted">
								{{ $table->name }}
							</a>
						</span>
					@empty
					<p class="m-0">Mohon segera lakukan konfigurasi tabel melalui <a href="{{ route('master.generateTable') }}" class="dotted">tautan ini</a>.</p>
					@endforelse
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<div class="d-flex align-items-center justify-content-between flex-wrap">
					<div class="wrap">
						<i class="bi bi-info-circle me-2"></i>
						{{ $quotes['quote'] }}
					</div>
					{{ $quotes['by'] }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection