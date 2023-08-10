@extends('layouts.panel')
@section('title', Str::headline($table))
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<h3>Dashboard</h3>
			@include('components.breadcrumbs')
			<div class="card">
				<div class="card-header text-bg-color d-flex align-items-center justify-content-between">
					<div class="wrap">
						<i class="bi bi-database me-2"></i>
						<span id="table-name">@yield('title')</span>
					</div>
					<div class="wrap">
						<a href="#" class="btn btn-sm btn-color">
							Import
							<i class="bi bi-filetype-csv ms-1"></i>
						</a>
						<a href="#" class="btn btn-sm btn-color">
							Insert
							<i class="bi bi-database-fill-add ms-1"></i>
						</a>
						{{-- <a class="btn btn-sm btn-color" href="#" data-bs-route="{{ route('master.formImport', $alias->name) }}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalControl" data-bs-table="{{ $alias->alias }}" data-bs-type="Import" onclick="event.preventDefault()" title="Import"><i class="fas fa-file-import"></i></a> --}}
						{{-- <a class="btn btn-sm btn-color" href="#" data-bs-route="{{ route('master.create', $alias->name) }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="{{ $alias->alias }}" data-bs-type="Create" onclick="event.preventDefault()" title="Insert"><i class="fas fa-file-circle-plus"></i></a> --}}
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm table-bordered server-side m-0">
							<thead>
								<tr>
									@foreach($columns as $column)
										<th>{{ Str::studly($column) }}</th>
									@endforeach
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									@foreach($columns as $column)
										<th>{{ Str::studly($column) }}</th>
									@endforeach
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Data yang ditampilkan merupakan .
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
