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
					<div class="table-responsive">
						<table class="table table-bordered table-sm m-0 fetch">
							<thead>
								<tr>
									<th>id</th>
									<th>parent_id</th>
									<th>has_child</th>
									<th>name</th>
									<th>order</th>
								</tr>
							</thead>
							<tbody>
							@foreach (menu() as $element)
								<tr>
									<td>{{ $element->id }}</td>
									<td>{{ $element->parent_id }}</td>
									<td>{{ $element->has_child }}</td>
									<td>{{ $element->name }}</td>
									<td>{{ $element->order_number }}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Data yang ditampilkan sudah disesuaikan dengan kebutuhan.
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
