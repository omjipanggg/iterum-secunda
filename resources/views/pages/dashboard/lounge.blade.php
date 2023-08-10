@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<h3>Dashboard</h3>
			@include('components.breadcrumbs')
			<div class="card">
				<div class="card-header text-bg-brighter-color">
					<i class="bi bi-cup-hot me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 offset-lg-4">
							<img src="{{ asset('img/relax.webp') }}" alt="Relax" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
