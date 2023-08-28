@extends('layouts.panel')
@section('title', Str::headline($table->label))
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="mb-4">
			<div class="card">
				<div class="card-body">
				<h3>Dashboard</h3>
				{{ Breadcrumbs::render('master.fetch', $table) }}
				</div>
			</div>
			</div>
			<div class="card">
				<div class="card-header text-bg-color d-flex align-items-center justify-content-between">
					<div class="wrap">
						<i class="bi bi-database me-2"></i>
						<span id="table-name">@yield('title')</span>
					</div>
					<div class="wrap">
						<a class="btn btn-sm btn-outline-color" href="{{ route('master.import', $table->code) }}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalControl" data-bs-table="{{ $table->label }}" data-bs-type="Unggah" onclick="event.preventDefault()" title="Unggah">
							Unggah
							<i class="bi bi-box-arrow-up-right ms-1"></i>
						</a>
						<a class="btn btn-sm btn-outline-color" href="{{ route('master.create', $table->code) }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="{{ $table->label }}" data-bs-type="Tambah" onclick="event.preventDefault()" title="Tambah">
							Tambah
							<i class="bi bi-box-arrow-up-right ms-1"></i>
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm table-bordered server-side m-0">
							<thead>
								<tr>
									<th colspan="2">Action</th>
									@foreach($columns as $column)
										@if ($column == 'edit' || $column == 'delete')
										@else
										<th rowspan="2">{{ Str::ucfirst($column) }}</th>
										@endif
									@endforeach
								</tr>
								<tr>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									@foreach($columns as $column)
										<th>{{ Str::ucfirst($column) }}</th>
									@endforeach
								</tr>
							</tfoot>
						</table>
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
<div class="mb-3"></div>
@endsection
