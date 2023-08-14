@extends('layouts.panel')
@section('title', 'Master')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col-12">
			<div class="mb-4">
				<h3>Dashboard</h3>
				{{ Breadcrumbs::render('master.index') }}
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
					<p class="m-0">Mohon segera lakukan konfigurasi, <a href="{{ route('master.generateTable') }}" class="dotted">di sini</a>.</p>
					@endforelse
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Laporkan kesalahan melalui <a href="{{ route('home.index') }}" class="underlined">tautan ini</a>.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection